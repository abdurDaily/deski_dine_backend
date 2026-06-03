<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Order;
use App\Services\SSLCommerzService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * SSLCommerz Success callback.
     */
    public function success(Request $request)
    {
        $tranId = $request->input('tran_id');
        $valId = $request->input('val_id');

        $order = Order::where('transaction_id', $tranId)->first();

        if (!$order) {
            return redirect()->route('frontend.home')->with('error', 'Order not found.');
        }

        if (!$valId) {
            $order->update([
                'payment_status'  => 'failed',
                'payment_details' => json_encode($request->all()),
            ]);

            return redirect()->route('frontend.checkout')
                ->with('error', 'Payment validation failed (missing val_id). Please contact support.');
        }

        $sslcommerz = new SSLCommerzService();
        $validation = $sslcommerz->validateTransaction($valId);

        if (($validation['status'] ?? null) === 'VALID' || ($validation['status'] ?? null) === 'VALIDATED') {
            $this->markOrderAsPaid($order, $validation);

            return $this->redirectToCheckoutWithStatus(
                'success',
                'Payment successful! Order #' . $order->id . ' confirmed.',
                true
            );
        }

        $order->update([
            'payment_status'  => 'failed',
            'payment_details' => json_encode($validation ?: $request->all()),
        ]);

        return $this->redirectToCheckoutWithStatus(
            'fail',
            'Payment was not completed. Please try again.'
        );
    }

    /**
     * SSLCommerz Fail callback.
     */
    public function fail(Request $request)
    {
        $tranId = $request->input('tran_id');
        $order = Order::where('transaction_id', $tranId)->first();

        if ($order) {
            $order->update([
                'payment_status'  => 'failed',
                'status'          => 'pending',
                'payment_details' => json_encode($request->all()),
            ]);
        }

        return $this->redirectToCheckoutWithStatus(
            'fail',
            'Payment failed. Please try again or choose a different method.'
        );
    }

    /**
     * SSLCommerz Cancel callback.
     */
    public function cancel(Request $request)
    {
        $tranId = $request->input('tran_id');
        $order = Order::where('transaction_id', $tranId)->first();

        if ($order) {
            $order->update([
                'payment_status'  => 'cancelled',
                'status'          => 'canceled',
                'payment_details' => json_encode($request->all()),
            ]);
        }

        return $this->redirectToCheckoutWithStatus(
            'cancel',
            'Payment was cancelled.'
        );
    }

    /**
     * SSLCommerz IPN (Instant Payment Notification) - server-to-server.
     */
    public function ipn(Request $request)
    {
        $tranId = $request->input('tran_id');
        $status = $request->input('status');
        $valId = $request->input('val_id');

        Log::info('SSLCommerz IPN received', $request->all());

        $order = Order::where('transaction_id', $tranId)->first();

        if (!$order) {
            return response()->json(['status' => 'order_not_found'], 404);
        }

        // Validate with SSLCommerz server
        $sslcommerz = new SSLCommerzService();
        if (!$valId) {
            return response()->json(['status' => 'missing_val_id'], 422);
        }

        $validation = $sslcommerz->validateTransaction($valId);

        if (($validation['status'] ?? null) === 'VALID' || ($validation['status'] ?? null) === 'VALIDATED') {
            $this->markOrderAsPaid($order, $validation);
        }

        return response()->json(['status' => 'ok']);
    }

    private function redirectToCheckoutWithStatus(string $status, string $message, bool $clearCart = false)
    {
        $query = [
            'payment_result' => $status,
            'payment_message' => $message,
        ];

        if ($clearCart) {
            $query['clear_cart'] = '1';
        }

        return redirect()->route('frontend.checkout', $query);
    }

    private function markOrderAsPaid(Order $order, array $details): void
    {
        $wasAlreadyPaid = $order->payment_status === 'paid';

        $order->update([
            'payment_status'  => 'paid',
            'payment_date'    => now(),
            'status'          => 'confirmed',
            'payment_details' => json_encode($details),
        ]);

        if ($wasAlreadyPaid || !$order->member_id) {
            return;
        }

        $member = Member::find($order->member_id);
        if (!$member) {
            return;
        }

        $member->total_purchase += (float) $order->final_amount;
        $member->first_order_discount_used = $member->first_order_discount_used || ((float) $order->discount_amount > 0);

        if ($member->type !== 'golden' && (float) $order->total_amount >= 2000) {
            $member->type = 'golden';
        }

        $member->save();
    }
}
