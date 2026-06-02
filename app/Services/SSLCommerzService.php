<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SSLCommerzService
{
    protected string $storeId;
    protected string $storePassword;
    protected string $apiUrl;

    public function __construct()
    {
        $this->storeId = config('sslcommerz.store_id');
        $this->storePassword = config('sslcommerz.store_password');
        $this->apiUrl = config('sslcommerz.sandbox')
            ? 'https://sandbox.sslcommerz.com'
            : 'https://securepay.sslcommerz.com';
    }

    /**
     * Initiate SSLCommerz payment session.
     */
    public function initiatePayment(array $data): array
    {
        $postData = [
            'store_id'     => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => $data['total_amount'],
            'currency'     => 'BDT',
            'tran_id'      => $data['tran_id'],
            'success_url'  => route('payment.success'),
            'fail_url'     => route('payment.fail'),
            'cancel_url'   => route('payment.cancel'),
            'ipn_url'      => route('payment.ipn'),

            // Customer Information
            'cus_name'    => $data['cus_name'],
            'cus_email'   => $data['cus_email'] ?? 'customer@example.com',
            'cus_add1'    => $data['cus_add1'],
            'cus_city'    => $data['cus_city'] ?? 'Chittagong',
            'cus_country' => 'Bangladesh',
            'cus_phone'   => $data['cus_phone'],

            // Shipping Information
            'shipping_method' => 'NO',
            'num_of_item'     => $data['num_of_item'] ?? 1,
            'product_name'    => $data['product_name'] ?? 'Food Order',
            'product_category' => 'Food',
            'product_profile' => 'general',
        ];

        try {
            $response = Http::asForm()->post($this->apiUrl . '/gwprocess/v4/api.php', $postData);
            $result = $response->json();

            if (isset($result['status']) && $result['status'] === 'SUCCESS') {
                return [
                    'success'      => true,
                    'gateway_url'  => $result['GatewayPageURL'],
                    'session_key'  => $result['sessionkey'] ?? null,
                ];
            }

            Log::error('SSLCommerz initiation failed', ['response' => $result]);
            return [
                'success' => false,
                'message' => $result['failedreason'] ?? 'Payment initiation failed.',
            ];
        } catch (\Exception $e) {
            Log::error('SSLCommerz exception', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Could not connect to payment gateway.',
            ];
        }
    }

    /**
     * Validate a transaction by its ID.
     */
    public function validateTransaction(string $valId): array
    {
        try {
            $response = Http::asForm()->post($this->apiUrl . '/validator/api/validationserverAPI.php', [
                'store_id'     => $this->storeId,
                'store_passwd' => $this->storePassword,
                'val_id'       => $valId,
                'format'       => 'json',
            ]);

            return $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('SSLCommerz validation error', ['error' => $e->getMessage()]);
            return [];
        }
    }
}
