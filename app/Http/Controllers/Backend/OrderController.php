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
                ->rawColumns(['member', 'card_number', 'total', 'discount', 'final', 'status_name', 'date'])
                ->make(true);
        }

        return view('backend.orders.index');
    }
}
