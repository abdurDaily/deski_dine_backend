<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('index');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'is_student' => 'sometimes|boolean',
        ]);

        $member = Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'last4' => substr(preg_replace('/\D+/', '', $request->phone), -4),
            'is_student' => $request->boolean('is_student'),
            'type' => 'membership',
            'status' => 'active',
        ]);

        $member->unique_card_number = sprintf('MEM%s_%s', str_pad($member->id, 4, '0', STR_PAD_LEFT), $member->last4);
        $member->save();

        return back()->with('success', 'Membership registered successfully. Your card number is ' . $member->unique_card_number . '.');
    }

    public function applyGoldenCard(Request $request)
    {
        $request->validate([
            'unique_card_number' => 'required|string',
        ]);

        $member = Member::where('unique_card_number', $request->unique_card_number)->first();

        if (! $member) {
            return back()->withErrors(['unique_card_number' => 'Membership card number not found.']);
        }

        $member->update(['type' => 'golden']);

        return back()->with('success', 'Golden card request received. Your membership has been upgraded to golden.');
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:cod,bkash,other',
            'order_total' => 'required|numeric|min:0',
            'member_card_number' => 'required|string',
            'student_card' => 'sometimes|boolean',
            'items' => 'nullable|string',
        ]);

        $member = Member::where('unique_card_number', $request->member_card_number)->first();
        if (! $member) {
            return back()->withErrors(['member_card_number' => 'Membership card number not found. Please register first.'])->withInput();
        }
        $discountPercent = 0;
        $studentCardUsed = $request->boolean('student_card');
        $orderTotal = (float) $request->order_total;

        if ($request->filled('member_card_number')) {
            $member = Member::where('unique_card_number', $request->member_card_number)->first();
        }

        if ($member && $member->orders()->count() === 0) {
            if ($studentCardUsed || $member->is_student) {
                $discountPercent = 35;
            } else {
                $discountPercent = 30;
            }
        }

        $discountAmount = round($orderTotal * ($discountPercent / 100), 2);
        $finalAmount = round($orderTotal - $discountAmount, 2);

        $order = Order::create([
            'member_id' => $member?->id,
            'unique_card_number' => $member?->unique_card_number,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'total_amount' => $orderTotal,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'student_card_used' => $studentCardUsed,
            'items' => $request->filled('items') ? json_decode($request->items, true) : [],
            'status' => 'pending',
        ]);

        if ($member) {
            $member->total_purchase += $orderTotal;
            $member->first_order_discount_used = $member->first_order_discount_used || $discountAmount > 0;

            if ($member->type !== 'golden' && $orderTotal >= 2000) {
                $member->type = 'golden';
            }

            $member->save();
        }

        $successMessage = 'Order placed successfully. Total: ৳' . number_format($finalAmount, 2);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $successMessage]);
        }

        return redirect()->route('frontend.checkout')->with('success', $successMessage);
    }
}
