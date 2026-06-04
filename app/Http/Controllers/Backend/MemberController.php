<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $members = Member::query()
            ->withSum(['orders as computed_total_purchase' => function ($q) {
                $q->whereIn('status', ['confirmed', 'completed']);
            }], 'final_amount')
            ->withCount('orders')
            ->when($search, function ($query, $search) {
                return $query->where('unique_card_number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('backend.members.index', compact('members', 'search'));
    }

    /**
     * Get member details for AJAX modal.
     */
    public function show(Member $member)
    {
        $member->loadSum(['orders as computed_total_purchase' => function ($q) {
            $q->whereIn('status', ['confirmed', 'completed']);
        }], 'final_amount');
        $member->loadCount('orders');
        $member->load(['orders' => function ($q) {
            $q->latest()->take(10);
        }]);

        return response()->json([
            'success' => true,
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'phone' => $member->phone,
                'email' => $member->email,
                'dob' => $member->dob?->format('Y-m-d'),
                'marriage_date' => $member->marriage_date?->format('Y-m-d'),
                'address' => $member->address,
                'unique_card_number' => $member->unique_card_number,
                'type' => $member->type,
                'status' => $member->status,
                'is_student' => $member->is_student,
                'profile_image_url' => $member->profile_image_path ? asset('storage/' . $member->profile_image_path) : null,
                'student_card_url' => $member->student_card_path ? asset('storage/' . $member->student_card_path) : null,
                'total_purchase' => (float) ($member->computed_total_purchase ?? 0),
                'orders_count' => $member->orders_count,
                'first_order_discount_used' => $member->first_order_discount_used,
                'expires_at' => $member->expires_at?->format('Y-m-d'),
                'created_at' => $member->created_at->format('Y-m-d'),
                'recent_orders' => $member->orders->map(fn($o) => [
                    'id' => $o->id,
                    'final_amount' => number_format($o->final_amount, 2),
                    'status' => $o->status,
                    'date' => $o->created_at->format('Y-m-d'),
                ]),
            ],
        ]);
    }

    /**
     * Toggle member status (active/suspended).
     */
    public function toggleStatus(Member $member)
    {
        $member->status = $member->status === 'active' ? 'suspended' : 'active';
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Member status changed to ' . ucfirst($member->status) . '.',
            'new_status' => $member->status,
        ]);
    }

    /**
     * Sync the stored total_purchase column with actual order amounts.
     */
    public function syncPurchase(Member $member)
    {
        $computedTotal = $member->orders()
            ->whereIn('status', ['confirmed', 'completed'])
            ->sum('final_amount');

        $member->total_purchase = $computedTotal;
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Total purchase synced: ৳' . number_format($computedTotal, 2),
            'total_purchase' => (float) $computedTotal,
        ]);
    }
}
