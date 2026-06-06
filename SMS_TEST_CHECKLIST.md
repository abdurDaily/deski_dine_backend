# SMS Integration Test Checklist

## ✅ Pre-Test Verification

- [ ] Internet connection is active
- [ ] Laravel application is running (`php artisan serve`)
- [ ] Phone number ready (in format: 01712345678 or +8801712345678)
- [ ] SMS log file accessible at `storage/logs/laravel.log`
- [ ] Have a smartphone to receive SMS

---

## Test 1: Welcome SMS (Member Registration)

### Steps
1. [ ] Open browser and go to frontend homepage
2. [ ] Find and click "Apply for Membership" button
3. [ ] Fill in the registration form:
   - [ ] Name: Enter any name
   - [ ] Phone: Enter your test phone number
   - [ ] Email: Enter valid email (optional)
   - [ ] DOB: Select any date
   - [ ] Address: Enter any address
   - [ ] Profile Image: Upload or skip
   - [ ] Student Card: Only if marking as student
4. [ ] Click "Submit" button
5. [ ] Wait for success message on screen
6. [ ] Check your phone for SMS

### Expected Results
- [ ] Registration succeeds (message shows card number)
- [ ] SMS received within 10 seconds
- [ ] SMS contains your name and login link
- [ ] Example SMS: "Welcome John Doe! Your account has been created successfully. Login at: http://127.0.0.1:8000/member-login"

### If SMS Not Received
- [ ] Check `storage/logs/laravel.log` for error messages
- [ ] Look for lines containing: `Welcome SMS sent` or `Failed to send welcome SMS`
- [ ] Verify phone number formatting
- [ ] Check internet connection

---

## Test 2: Payment Confirmation SMS

### Prerequisites
- [ ] You have a registered member account (from Test 1)
- [ ] You have some menu items available in the system
- [ ] Test payment gateway is configured (SSL Commerz test credentials)

### Steps
1. [ ] Log in as customer (not admin)
2. [ ] Browse and add items to cart
3. [ ] Click "Checkout"
4. [ ] Fill shipping/delivery details
5. [ ] Select payment method: "Pay Now"
6. [ ] Complete payment process (use test credentials)
7. [ ] Wait for order confirmation on screen
8. [ ] Check your phone for SMS

### Expected Results
- [ ] Order is marked as "confirmed"
- [ ] SMS received within 10 seconds
- [ ] SMS contains amount, transaction ID, and login link
- [ ] Example SMS: "Payment Confirmed! Dear John Doe, you have successfully paid ৳500.00. Transaction ID: TXN123456. Access your account: http://127.0.0.1:8000/member-login"

### If SMS Not Received
- [ ] Check `storage/logs/laravel.log` for error messages
- [ ] Look for lines containing: `Payment confirmation SMS sent` or `Failed to send payment confirmation SMS`
- [ ] Verify order status is "confirmed" in database
- [ ] Check if member has a phone number in profile

---

## Test 3: Log Verification

### How to Check Logs

**Using PowerShell (Windows):**
```powershell
Get-Content "storage/logs/laravel.log" -Tail 100
```

**Using Command Prompt (Windows):**
```cmd
type storage\logs\laravel.log | find /C "SMS"
```

### Log Patterns to Look For

**Success Pattern:**
```
[2026-06-07 14:30:45] local.INFO: Welcome SMS sent to member {"member_id":1,"phone":"+8801712345678","name":"John Doe"}
```

**Failure Pattern:**
```
[2026-06-07 14:30:45] local.WARNING: Failed to send welcome SMS to member {"member_id":1,"phone":"+8801712345678","error":"Invalid phone number format"}
```

**Exception Pattern:**
```
[2026-06-07 14:30:45] local.ERROR: Exception while sending welcome SMS {"member_id":1,"exception":"Connection timeout"}
```

---

## Test 4: Phone Number Formatting

### How to Test Formatting

Create a test route temporarily in `routes/web.php`:
```php
Route::get('/test/sms-format/{phone}', function($phone) {
    return [
        'input' => $phone,
        'formatted' => format_phone($phone),
        'is_valid' => preg_match('/^\+\d{10,15}$/', format_phone($phone)) === 1
    ];
});
```

Then visit in browser:
```
http://127.0.0.1:8000/test/sms-format/01712345678
http://127.0.0.1:8000/test/sms-format/1712345678
http://127.0.0.1:8000/test/sms-format/8801712345678
```

### Expected Response
```json
{
  "input": "01712345678",
  "formatted": "+8801712345678",
  "is_valid": true
}
```

---

## Test 5: Database Verification

### Check Member Record
```sql
SELECT id, name, phone, email, type, status, created_at FROM members 
WHERE phone LIKE '%01%' OR phone LIKE '%880%' 
ORDER BY created_at DESC LIMIT 1;
```

Expected columns in response:
- `id`: Member ID
- `name`: Test user name
- `phone`: Phone number (in any format)
- `type`: Should be "membership" or "golden"
- `status`: Should be "active"
- `created_at`: Recent timestamp

### Check Order Record (for Test 2)
```sql
SELECT id, member_id, status, payment_status, transaction_id, final_amount, created_at 
FROM orders 
WHERE member_id = 1 
ORDER BY created_at DESC LIMIT 1;
```

Expected columns:
- `status`: Should be "confirmed"
- `payment_status`: Should be "paid"
- `transaction_id`: Should have a value
- `final_amount`: Should have amount

---

## Troubleshooting Guide

### Problem: "Invalid phone number format" in logs

**Likely Cause:** Phone number not in international format with +

**Solution:**
1. Check input phone format
2. Verify `format_phone()` function is working
3. Test the formatting endpoint (Test 4)
4. Phone should start with + after formatting

### Problem: SMS service not sending

**Likely Cause:** SMSQ API credentials incorrect or API not reachable

**Solution:**
1. Verify credentials in `app/Services/SmsService.php`
2. Check internet connection
3. Test API endpoint manually using Postman/curl:
```bash
curl -X POST https://console.smsq.global/api/v2/SendSMS \
  -H "Content-Type: application/json" \
  -d '{
    "ClientId": "aeff5028-d333-4762-91c9-0d53d81394e7",
    "ApiKey": "X0haHzffFZo6V69T16mBZ+T/WLiuikBqgGMORDpTQuE=",
    "SenderId": "8809617611892",
    "Message": "Test message",
    "MobileNumbers": ["+8801712345678"]
  }'
```

### Problem: SMS logs show success but no SMS received

**Likely Cause:** 
- SMSQ sender ID not approved
- Recipient phone number issue
- Network issue with phone

**Solution:**
1. Contact SMSQ support to verify sender ID is approved
2. Try with a different phone number
3. Check if phone can receive SMS from other sources
4. Try SMS from SMSQ web console directly

### Problem: Member/Order not found in database

**Likely Cause:** Registration or payment didn't complete successfully

**Solution:**
1. Check browser console for JavaScript errors
2. Check `storage/logs/laravel.log` for validation errors
3. Verify form data was correct
4. Try again with valid data

---

## Success Indicators

✅ **All tests passed when:**
- SMS received within 10 seconds of registration
- SMS received within 10 seconds of payment
- SMS contains correct information (name, amount, links)
- Logs show "SMS sent successfully" messages
- No error messages in `storage/logs/laravel.log`

---

## Next Steps After Testing

1. **Document any issues found** and create support tickets
2. **Update SMSQ credentials** if using production credentials
3. **Customize SMS messages** if needed in `SmsService.php`
4. **Monitor SMS usage** and costs with SMSQ
5. **Set up SMS in additional workflows** (if needed)

---

**Test Date:** ___________  
**Tester Name:** ___________  
**Status:** Pass [ ] / Fail [ ] / Partial [ ]  
**Notes:** ___________________________________________

---

**Last Updated:** June 7, 2026
