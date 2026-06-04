<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Order::with('member')->select(['id', 'member_id', 'unique_card_number', 'customer_name', 'customer_phone', 'total_amount', 'discount_amount', 'final_amount', 'status', 'created_at']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('member', fn($order) => $order->member?->name ?? '-')
                ->addColumn('card_number', fn($order) => $order->unique_card_number ?? '-')
                ->addColumn('total', fn($order) => '৳ ' . number_format($order->total_amount, 2))
                ->addColumn('discount', fn($order) => '৳ ' . number_format($order->discount_amount, 2))
                ->addColumn('final', fn($order) => '৳ ' . number_format($order->final_amount, 2))
                ->addColumn('status_name', fn($order) => ucfirst($order->status))
                ->addColumn('date', fn($order) => $order->created_at->format('Y-m-d'))
                ->addColumn('action', function($order) {
                    return '<button class="btn btn-sm btn-info view-order-btn" data-id="' . $order->id . '" data-url="' . route('orders.show', $order->id) . '"><i class="fas fa-eye"></i> View</button>';
                })
                ->rawColumns(['member', 'card_number', 'total', 'discount', 'final', 'status_name', 'date', 'action'])
                ->make(true);
        }

        return view('backend.orders.index');
    }

    public function show(Order $order)
    {
        $order->load('member');
        return view('backend.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,canceled',
            'payment_status' => 'required|in:unpaid,paid,failed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        if ($order->status === 'completed' || $order->payment_status === 'paid') {
            $order->creditMemberPurchase();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully.',
        ]);
    }
}
