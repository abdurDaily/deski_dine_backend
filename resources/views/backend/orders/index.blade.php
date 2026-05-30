@extends('dashboard')
@section('title', 'Orders')
@section('content')
    <x-breadcrumb></x-breadcrumb>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Orders</h4>
                    <form method="GET" class="d-flex align-items-center" action="{{ route('orders.index') }}">
                        <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Search by name, phone, card number" />
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Card Number</th>
                                    <th>Member</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Final</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td>{{ $order->unique_card_number ?? '-' }}</td>
                                        <td>{{ $order->member?->name ?? '-' }}</td>
                                        <td>৳ {{ number_format($order->total_amount, 2) }}</td>
                                        <td>৳ {{ number_format($order->discount_amount, 2) }}</td>
                                        <td>৳ {{ number_format($order->final_amount, 2) }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
