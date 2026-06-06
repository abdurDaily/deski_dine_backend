# SMS Integration Guide - Deski Dine

## Overview
This guide explains how to send SMS notifications to users for:
- Membership card registration
- Payment confirmation  
- Dashboard credentials (email + password)
- Account creation
- OTP verification

## SMS Configuration

Your SMS credentials are already configured in `app/Services/SmsService.php`:

```php
API URL: https://console.smsq.global/api/v2/SendSMS
API Key: X0haHzffFZo6V69T16mBZ+T/WLiuikBqgGMORDpTQuE=
Client ID: aeff5028-d333-4762-91c9-0d53d81394e7
Sender ID: 8809617611892 (APPROVED)
```

---

## Usage Examples

### 1. Send Credentials SMS After Registration

**In your RegisterController:**

```php
use App\Services\SmsService;

public function register(Request $request)
{
    // Create user...
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($password = str_random(8)),
        'phone' => format_phone($request->phone) // Format: +8801XXXXXXXXX
    ]);

    // Send credentials via SMS
    $phone = format_phone($request->phone);
    $response = send_credentials_sms($phone, $user->email, $password);
    
    if ($response['success']) {
        return redirect()->route('login')->with('success', 'Account created! Credentials sent via SMS.');
    } else {
        return back()->with('warning', 'Account created but SMS failed to send.');
    }
}
```

### 2. Send SMS After Payment Success

**In your PaymentController (modify the success method):**

```php
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
    $member = $order->member;
    if ($member && $member->phone) {
        $response = send_payment_sms(
            $member->phone,           // Phone number
            $member->name,            // User name
            $order->total_amount,     // Amount
            $order->transaction_id    // Transaction ID
        );
        
        \Log::info('Payment SMS sent', ['response' => $response]);
    }
}
```

### 3. Send Welcome SMS After Member Card Registration

**In your MemberController:**

```php
public function store(Request $request)
{
    $member = Member::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => format_phone($request->phone),
        'card_number' => $this->generateCardNumber(),
        // ... other fields
    ]);

    // Send welcome SMS
    $response = send_welcome_sms(
        $member->phone,
        $member->name
    );

    if ($response['success']) {
        return redirect()->back()->with('success', 'Member registered and SMS sent!');
    }
}
```

### 4. Send OTP SMS for Verification

**In your OTP Controller:**

```php
public function sendOtp(Request $request)
{
    $phone = format_phone($request->phone);
    $otp = rand(100000, 999999);

    // Store OTP temporarily (cache or database)
    \Cache::put("otp_{$phone}", $otp, now()->addMinutes(10));

    // Send OTP
    $smsService = app(\App\Services\SmsService::class);
    $response = $smsService->sendOtpSms($phone, $otp);

    if ($response['success']) {
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully'
        ]);
    }
}
```

### 5. Send Custom SMS

**For any custom message:**

```php
// Using helper
$response = send_sms('+8801234567890', 'Your custom message here');

// Or using service directly
$smsService = app(\App\Services\SmsService::class);
$response = $smsService->sendSms('+8801234567890', 'Your message');

// Check response
if ($response['success']) {
    echo "SMS sent successfully!";
} else {
    echo "Error: " . $response['error'];
}
```

---

## Phone Number Formatting

The system expects phone numbers in international format: **+8801XXXXXXXXX**

### Using the Helper:

```php
// Input: 01234567890
// Output: +8801234567890
$formattedPhone = format_phone('01234567890');

// Custom country code
$formattedPhone = format_phone('1234567890', '+91'); // India format
```

### Examples:

```php
format_phone('01234567890')        // → +8801234567890 (Bangladesh)
format_phone('8801234567890')      // → +8801234567890
format_phone('+8801234567890')     // → +8801234567890 (unchanged)
format_phone('01234567890', '+91') // → +911234567890 (India)
```

---

## Complete Implementation Example

### User Registration with SMS

Create a new method in `app/Http/Controllers/Auth/RegisterController.php`:

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/member/dashboard';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^(\+?88)?01[3-9]\d{8}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Generate temporary password if not provided
        $tempPassword = $data['password'] ?? str_random(10);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => format_phone($data['phone']),
            'password' => Hash::make($tempPassword),
            'role' => 'member',
            'status' => 'active',
        ]);

        // Send credentials via SMS
        $response = send_credentials_sms(
            $user->phone,
            $user->email,
            $tempPassword
        );

        if (!$response['success']) {
            \Log::warning('SMS failed for user registration', [
                'user_id' => $user->id,
                'error' => $response['error']
            ]);
        }

        return $user;
    }
}
```

### Payment Controller with SMS

Modify `app/Http/Controllers/Frontend/PaymentController.php`:

```php
private function markOrderAsPaid(Order $order, array $details): void
{
    $order->update([
        'payment_status'  => 'paid',
        'payment_date'    => now(),
        'status'          => 'confirmed',
        'payment_details' => json_encode($details),
    ]);

    $order->creditMemberPurchase();

    // Send SMS notification
    $this->sendPaymentNotificationSms($order);
}

private function sendPaymentNotificationSms(Order $order): void
{
    $member = $order->member;
    
    if (!$member || !$member->phone) {
        return;
    }

    $response = send_payment_sms(
        $member->phone,
        $member->name,
        number_format($order->total_amount, 2),
        $order->transaction_id
    );

    \Log::info('Payment SMS notification', [
        'order_id' => $order->id,
        'phone' => $member->phone,
        'success' => $response['success']
    ]);
}
```

---

## Response Format

All SMS functions return an array:

### Success Response:
```php
[
    'success' => true,
    'message' => 'SMS sent successfully',
    'data' => [
        'MessageId' => '123456',
        'Status' => 'Sent',
        // ... other API response data
    ]
]
```

### Error Response:
```php
[
    'success' => false,
    'error' => 'Invalid phone number format',
    'message' => 'Phone number must be in international format'
]
```

---

## SMS Messages Templates

The system includes these pre-formatted messages:

### 1. Credentials Message
```
Your account credentials:
Email: user@example.com
Password: tempPassword123
Login: https://yoursite.com/member/login
Thank you!
```

### 2. Welcome Message
```
Welcome John! Your account has been created successfully. 
Login at: https://yoursite.com/member/login
```

### 3. Payment Confirmation
```
Payment Confirmed! Dear John, you have successfully paid 5000. 
Transaction ID: TXN123456. 
Access your account: https://yoursite.com/member/login
```

### 4. OTP Message
```
Your OTP is: 123456. This code is valid for 10 minutes.
```

---

## Error Handling

Check the logs for SMS errors:

```bash
# View SMS logs
tail -f storage/logs/laravel.log | grep SMS

# Or in code
\Log::info('SMS sent', $response);
```

Common errors:

| Error | Solution |
|-------|----------|
| Invalid phone number | Use `format_phone()` helper |
| API Key invalid | Check SmsService.php configuration |
| Timeout | Check internet connection |
| Daily limit exceeded | Contact SMS provider |

---

## Best Practices

1. **Always format phone numbers:**
   ```php
   $phone = format_phone($request->phone);
   send_sms($phone, 'Message');
   ```

2. **Log all SMS operations:**
   ```php
   \Log::info('SMS sent to ' . $phone);
   ```

3. **Handle failures gracefully:**
   ```php
   $response = send_sms($phone, 'Message');
   if (!$response['success']) {
       \Log::warning('SMS failed: ' . $response['error']);
       // Don't block the user flow
   }
   ```

4. **Batch send for multiple users:**
   ```php
   $smsService = app(\App\Services\SmsService::class);
   $results = $smsService->batchSendSms([
       '+8801234567890',
       '+8801234567891',
       '+8801234567892'
   ], 'Your message');
   ```

5. **Use transactions for critical operations:**
   ```php
   \DB::transaction(function () {
       $user = User::create($data);
       send_credentials_sms($user->phone, $user->email, $password);
       // Other operations
   });
   ```

---

## Testing

To test SMS without sending actual messages:

Create a `.env.local` file with:
```
SMS_ENABLED=false
```

Then check in SmsService:
```php
if (config('services.sms.enabled') === false) {
    return [
        'success' => true,
        'message' => 'SMS test mode (not sent)'
    ];
}
```

---

## Summary

✅ SMS service is ready to use  
✅ Easy helper functions available  
✅ Support for multiple message types  
✅ Automatic phone number formatting  
✅ Built-in error handling and logging  

**Start sending SMS today!**

