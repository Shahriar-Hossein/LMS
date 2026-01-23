<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Course;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SSLCommerzService
{
    protected string $storeId;
    protected string $storePassword;
    protected string $apiUrl;
    protected bool $isSandbox;

    public function __construct()
    {
        $this->storeId = config('services.sslcommerz.store_id');
        $this->storePassword = config('services.sslcommerz.store_password');
        $this->isSandbox = config('services.sslcommerz.sandbox', true);
        
        $this->apiUrl = $this->isSandbox 
            ? 'https://sandbox.sslcommerz.com'
            : 'https://securepay.sslcommerz.com';
    }

    public function initiatePayment(Course $course, $user)
    {
        $transactionId = 'TXN-' . time() . '-' . Str::random(10);
        
        // Calculate final amount
        $amount = $course->price;
        if ($course->discount > 0) {
            $amount = $course->price - $course->discount;
        }

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'currency' => 'BDT',
            'status' => 'pending',
        ]);

        // Prepare data for SSLCommerz
        $postData = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => $amount,
            'currency' => 'BDT',
            'tran_id' => $transactionId,
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            
            // Customer information
            'cus_name' => $user->name,
            'cus_email' => $user->email,
            'cus_add1' => $user->address ?? 'N/A',
            'cus_city' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $user->phone_no ?? '01700000000',
            
            // Product information
            'product_name' => $course->title,
            'product_category' => 'Course',
            'product_profile' => 'general',
            
            // Shipping information (required by SSLCommerz)
            'shipping_method' => 'NO',
            'num_of_item' => 1,
        ];

        try {
            $response = Http::asForm()->post($this->apiUrl . '/gwprocess/v4/api.php', $postData);
            
            $result = $response->json();
            
            if (isset($result['status']) && $result['status'] === 'SUCCESS') {
                // Update payment with session key
                $payment->update([
                    'session_key' => $result['sessionkey'] ?? null,
                ]);
                
                return [
                    'success' => true,
                    'gateway_url' => $result['GatewayPageURL'],
                    'payment' => $payment,
                ];
            }
            
            return [
                'success' => false,
                'message' => $result['failedreason'] ?? 'Failed to initiate payment',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Payment gateway connection failed: ' . $e->getMessage(),
            ];
        }
    }

    public function validatePayment($transactionId, $amount, $currency = 'BDT')
    {
        $validationUrl = $this->apiUrl . '/validator/api/validationserverAPI.php';
        
        $response = Http::asForm()->post($validationUrl, [
            'val_id' => request('val_id'),
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
        ]);

        $result = $response->json();

        if (isset($result['status']) && $result['status'] === 'VALID') {
            if ($result['tran_id'] === $transactionId && 
                floatval($result['amount']) == floatval($amount) && 
                $result['currency'] === $currency) {
                return [
                    'valid' => true,
                    'data' => $result,
                ];
            }
        }

        return [
            'valid' => false,
            'message' => 'Payment validation failed',
        ];
    }

    public function processSuccess($postData)
    {
        $transactionId = $postData['tran_id'] ?? null;
        
        if (!$transactionId) {
            return ['success' => false, 'message' => 'Transaction ID not found'];
        }

        $payment = Payment::where('transaction_id', $transactionId)->first();
        
        if (!$payment) {
            return ['success' => false, 'message' => 'Payment record not found'];
        }

        // Validate the payment
        $validation = $this->validatePayment(
            $payment->transaction_id,
            $payment->amount,
            $payment->currency
        );

        if ($validation['valid']) {
            $payment->update([
                'status' => 'success',
                'payment_method' => $postData['card_type'] ?? null,
                'response_data' => json_encode($postData),
                'paid_at' => now(),
            ]);

            // Enroll user in course
            $user = $payment->user;
            $course = $payment->course;
            
            if (!$user->courses()->where('course_id', $course->id)->exists()) {
                $user->courses()->attach($course->id, [
                    'price_paid' => $payment->amount,
                    'progress' => 0,
                ]);
            }

            return [
                'success' => true,
                'payment' => $payment,
            ];
        }

        return ['success' => false, 'message' => 'Payment validation failed'];
    }

    public function processFail($postData)
    {
        $transactionId = $postData['tran_id'] ?? null;
        $payment = null;
        
        if ($transactionId) {
            $payment = Payment::where('transaction_id', $transactionId)->first();
            
            if ($payment) {
                $payment->update([
                    'status' => 'failed',
                    'response_data' => json_encode($postData),
                ]);
            }
        }

        return [
            'success' => false,
            'message' => 'Payment failed',
            'payment' => $payment,
        ];
    }

    public function processCancel($postData)
    {
        $transactionId = $postData['tran_id'] ?? null;
        $payment = null;
        
        if ($transactionId) {
            $payment = Payment::where('transaction_id', $transactionId)->first();
            
            if ($payment) {
                $payment->update([
                    'status' => 'cancelled',
                    'response_data' => json_encode($postData),
                ]);
            }
        }

        return [
            'success' => false,
            'message' => 'Payment cancelled',
            'payment' => $payment,
        ];
    }
}
