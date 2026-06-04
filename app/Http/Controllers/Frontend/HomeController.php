<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Offer;
use App\Models\Order;
use App\Services\SSLCommerzService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $categories = \App\Models\Category::with(['menus' => function ($query) {
            $query->where('is_available', 1)->with('variations');
        }])->where('status', 1)->get();

        $branches = \App\Models\Branch::orderBy('name')->get();

        return view('index', compact('categories', 'branches'));
    }

    public function addToCart()
    {
        return view('frontend.addtocart');
    }

    public function cardApply()
    {
        return view('frontend.apply');
    }


    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function cards()
    {
        $offers = Offer::active()->orderBy('created_at', 'desc')->get();
        return view('frontend.cards', compact('offers'));
    }

    public function registerMember(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'marriage_date' => 'nullable|date',
            'address' => 'nullable|string|max:1000',
            'is_student' => 'sometimes|boolean',
        ];

        if ($request->boolean('is_student')) {
            $rules['student_card'] = 'required|file|image|max:2048';
        }

        $request->validate($rules);

        $studentCardPath = null;
        if ($request->boolean('is_student') && $request->hasFile('student_card')) {
            $studentCardPath = $request->file('student_card')->store('student_cards', 'public');
        }

        $member = Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'marriage_date' => $request->marriage_date,
            'address' => $request->address,
            'last4' => substr(preg_replace('/\D+/', '', $request->phone), -4),
            'is_student' => $request->boolean('is_student'),
            'student_card_path' => $studentCardPath,
            'type' => 'membership',
            'status' => 'active',
            'expires_at' => now()->addYear(),
        ]);

        $member->unique_card_number = sprintf('MEM%s_%s', str_pad($member->id, 4, '0', STR_PAD_LEFT), $member->last4);
        $member->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Membership registered successfully. Your card number is ' . $member->unique_card_number, 'card' => $member->unique_card_number]);
        }

        return back()->with('success', 'Membership registered successfully. Your card number is ' . $member->unique_card_number . '.');
    }

    public function applyGoldenCard(Request $request)
    {
        $request->validate([
            'unique_card_number' => 'required|string',
        ]);

        $member = Member::where('unique_card_number', $request->unique_card_number)->first();

        if (!$member) {
            $msg = 'Membership card number not found.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 404);
            }
            return back()->withErrors(['unique_card_number' => $msg]);
        }

        if ($member->total_purchase < 2000) {
            $msg = 'You are not eligible for a Golden Card yet. Your total purchase is ৳' . number_format($member->total_purchase, 2) . ', but the eligibility requirement is ৳2,000.00.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->withErrors(['unique_card_number' => $msg]);
        }

        if ($member->type === 'golden') {
            $msg = 'You already have a Golden Card!';
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $msg]);
            }
            return back()->with('success', $msg);
        }

        $member->update([
            'type' => 'golden',
            'expires_at' => now()->addYears(5),
        ]);

        $msg = 'Congratulations! Your membership has been upgraded to Golden Card. Your card is now valid for 5 years with a 10% flat discount.';
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $msg]);
        }
        return back()->with('success', $msg);
    }

    public function storeOrder(Request $request)
    {
        // 1. Validate the Request
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'order_total' => 'required|numeric|min:1',
            'items' => 'required|json',
            'payment_method' => 'required|in:cod,sslcommerz',
            'member_card_number' => 'nullable|string|exists:members,unique_card_number',
            'student_card' => 'sometimes|boolean',
        ]);

        // 2. Generate unique Transaction ID
        $tranId = uniqid('ORDER_');

        $member = null;
        if ($request->filled('member_card_number')) {
            $member = Member::where('unique_card_number', $request->member_card_number)->first();
        }

        // 3. Prepare Order payload and save to Database
        // Map payment method to a safe DB value if enum doesn't support it yet
        $paymentMethod = $request->payment_method;
        if (Schema::hasColumn('orders', 'payment_method')) {
            $col = DB::select("SHOW COLUMNS FROM `orders` LIKE 'payment_method'");
            if (!empty($col) && isset($col[0]->Type) && strpos($col[0]->Type, 'enum(') === 0) {
                $typeDef = $col[0]->Type; // e.g. enum('cod','bkash','sslcommerz','other')
                if (strpos($typeDef, "'{$paymentMethod}'") === false) {
                    // fallback to 'other' when DB enum doesn't include the requested value
                    $paymentMethod = 'other';
                }
            }
        }

        $discountAmount = 0;
        if ($member) {
            $isExpired = $member->expires_at && $member->expires_at < now();
            if (!$isExpired) {
                if ($member->type === 'golden') {
                    $discountAmount = round($request->order_total * 0.10, 2);
                } elseif (!$member->first_order_discount_used) {
                    $rate = $member->is_student ? 0.35 : 0.30;
                    $discountAmount = round($request->order_total * $rate, 2);
                }
            }
        }

        $orderData = [
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $request->order_total,
            'discount_amount' => $discountAmount,
            'final_amount' => max(0, $request->order_total - $discountAmount),
            'items' => json_decode($request->items, true),
            'payment_method' => $paymentMethod,
            'status' => 'pending',
            'student_card_used' => $request->boolean('student_card'),
        ];

        if ($member) {
            $orderData['member_id'] = $member->id;
            $orderData['unique_card_number'] = $member->unique_card_number;
        }

        // Conditionally include transaction_id and payment_status only if the columns exist
        if (Schema::hasColumn('orders', 'transaction_id')) {
            $orderData['transaction_id'] = $tranId;
        }

        if (Schema::hasColumn('orders', 'payment_status')) {
            $orderData['payment_status'] = 'unpaid';
        }

        $order = Order::create($orderData);

        // ============================================
        // 4. Handle Payment Logic
        // ============================================

        // --- CASH ON DELIVERY ---
        if ($request->payment_method === 'cod') {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully via Cash on Delivery!',
                    'order_id' => $order->id,
                    'clear_cart' => true,
                ]);
            }

            return redirect()->route('frontend.checkout')->with([ 'success' => 'Order placed successfully via Cash on Delivery!', 'clear_cart' => true ]);
        }

        // --- SSLCOMMERZ (EASYCHECKOUT POPUP) ---
        if ($request->payment_method === 'sslcommerz') {
            try {
                $sslcommerz = new SSLCommerzService();

                $post_data = [
                    'total_amount' => $order->total_amount,
                    'currency' => 'BDT',
                    'tran_id' => $tranId,
                    'success_url' => route('payment.success'),
                    'fail_url' => route('payment.fail'),
                    'cancel_url' => route('payment.cancel'),
                    'ipn_url' => route('payment.ipn'),
                    'cus_name' => $order->customer_name,
                    'cus_email' => 'customer@example.com',
                    'cus_phone' => $order->customer_phone,
                    'cus_add1' => $order->customer_address,
                    'cus_city' => 'Dhaka',
                    'cus_country' => 'Bangladesh',
                    'shipping_method' => 'NO',
                    'product_name' => 'Food Order',
                    'product_category' => 'Food',
                    'product_profile' => 'general',
                ];

                $sslResponse = $sslcommerz->initiatePayment($post_data);

                if (!empty($sslResponse['success']) && !empty($sslResponse['gateway_url'])) {
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => true,
                            'redirect_url' => $sslResponse['gateway_url'],
                            'order_id' => $order->id,
                        ]);
                    }

                    return redirect()->away($sslResponse['gateway_url']);
                }

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $sslResponse['message'] ?? 'Payment initialization failed.',
                    ], 422);
                }

                return back()->withErrors(['payment' => $sslResponse['message'] ?? 'Payment initialization failed.']);
            } catch (\Exception $e) {
                Log::error('SSLCommerz Init Error: ' . $e->getMessage());
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'System error during payment initiation.'], 500);
                }
                return back()->withErrors(['payment' => 'System error during payment initiation.']);
            }
        }
    }

    public function checkMemberCard(Request $request)
    {
        $request->validate([
            'member_card_number' => 'required|string|exists:members,unique_card_number',
        ]);

        $member = Member::where('unique_card_number', $request->member_card_number)->first();
        if (! $member) {
            return response()->json([
                'eligible' => false,
                'message' => 'Membership card not found.',
            ], 404);
        }

        // Check card expiration
        $isExpired = $member->expires_at && $member->expires_at < now();
        if ($isExpired) {
            return response()->json([
                'eligible' => false,
                'member_name' => $member->name,
                'total_purchase' => (float) $member->total_purchase,
                'discount_rate' => 0,
                'message' => 'This membership card has expired. Validity is 1 year for standard and 5 years for golden.',
            ]);
        }

        if ($member->type === 'golden') {
            return response()->json([
                'eligible' => true,
                'member_name' => $member->name,
                'total_purchase' => (float) $member->total_purchase,
                'discount_rate' => 10,
                'message' => 'Golden Card Holder: 10% discount applied to all food items.',
            ]);
        }

        if ($member->first_order_discount_used) {
            return response()->json([
                'eligible' => false,
                'member_name' => $member->name,
                'total_purchase' => (float) $member->total_purchase,
                'discount_rate' => 0,
                'message' => 'No membership discount available. The first order discount has already been used.',
            ]);
        }

        $rate = $member->is_student ? 35 : 30;
        return response()->json([
            'eligible' => true,
            'member_name' => $member->name,
            'total_purchase' => (float) $member->total_purchase,
            'discount_rate' => $rate,
            'message' => sprintf('Welcome back! %d%% first-order discount applied to all food items.', $rate),
        ]);
    }

    public function completeMenu(Request $request)
    {
        // 1. Fetch active categories
        $categories = \App\Models\Category::where('status', 1)->get();

        // 2. Fetch min and max price limits dynamically from menu variations
        $minPriceLimit = (float) (\App\Models\MenuVariation::min('price') ?? 0);
        $maxPriceLimit = (float) (\App\Models\MenuVariation::max('price') ?? 1000);

        // 3. Get search/filter params
        $selectedCategorySlug = $request->query('category');
        $minPrice = $request->query('min_price', $minPriceLimit);
        $maxPrice = $request->query('max_price', $maxPriceLimit);

        // 4. Build query
        $query = \App\Models\Menu::where('is_available', 1)
            ->with(['variations', 'category']);

        // Filter by category slug
        if ($selectedCategorySlug) {
            $query->whereHas('category', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        // Filter by price range
        $query->whereHas('variations', function ($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('price', [$minPrice, $maxPrice]);
        });

        // 5. Paginate items (9 per page for perfect grid)
        $menus = $query->orderBy('name')->paginate(9)->withQueryString();

        // 6. Handle AJAX request
        if ($request->ajax()) {
            return view('frontend.partials.menu_grid', compact('menus'))->render();
        }

        return view('frontend.completeMenu', compact(
            'categories',
            'menus',
            'minPriceLimit',
            'maxPriceLimit',
            'selectedCategorySlug',
            'minPrice',
            'maxPrice'
        ));
    }
}
