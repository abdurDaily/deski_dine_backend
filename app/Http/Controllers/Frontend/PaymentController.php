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
        $order->update([
            'payment_status'  => 'paid',
            'payment_date'    => now(),
            'status'          => 'confirmed',
            'payment_details' => json_encode($details),
        ]);

        $order->creditMemberPurchase();

        // Send payment confirmation SMS
        $this->sendPaymentConfirmationSms($order);
    }

    /**
     * Send payment confirmation SMS to customer
     * @param Order $order
     * @return array
     */
    private function sendPaymentConfirmationSms(Order $order)
    {
        try {
            $member = $order->member;
            
            // Log the attempt
            Log::info('Attempting to send payment SMS', [
                'order_id' => $order->id,
                'member_id' => $member?->id,
                'member_phone' => $member?->phone ?? 'NULL',
                'order_customer_phone' => $order->customer_phone ?? 'NULL'
            ]);
            
            if (!$member || !$member->phone) {
                Log::warning('Cannot send payment SMS - member or phone not found', [
                    'order_id' => $order->id,
                    'member_id' => $member?->id,
                    'has_member' => $member ? 'yes' : 'no',
                    'member_phone' => $member?->phone ?? 'NULL'
                ]);
                return ['success' => false];
            }

            // Format phone number to international format
            $phone = format_phone($member->phone);
            
            Log::info('Formatted phone number', [
                'original' => $member->phone,
                'formatted' => $phone,
                'order_id' => $order->id
            ]);

            // Send payment confirmation SMS
            $response = send_payment_sms(
                $phone,
                $member->name,
                $order->final_amount,
                $order->transaction_id
            );

            if ($response['success']) {
                Log::info('Payment confirmation SMS sent successfully', [
                    'order_id' => $order->id,
                    'member_id' => $member->id,
                    'phone' => $phone,
                    'response' => $response
                ]);
            } else {
                Log::warning('Failed to send payment confirmation SMS', [
                    'order_id' => $order->id,
                    'member_id' => $member->id,
                    'phone' => $phone,
                    'error' => $response['error'] ?? 'Unknown error',
                    'full_response' => $response
                ]);
            }

            return $response;
        } catch (\Exception $e) {
            Log::error('Exception while sending payment confirmation SMS', [
                'order_id' => $order->id,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return ['success' => false];
        }
    }
}
