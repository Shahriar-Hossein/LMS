# SSLCommerz Payment Integration Documentation

## Overview
This document explains the SSLCommerz payment gateway integration for course enrollment in the LMS system.

## Configuration

### Environment Variables
Add these to your `.env` file:

```env
SSLCOMMERZ_STORE_ID=cyber670e1cc54b674
SSLCOMMERZ_STORE_PASSWORD=cyber670e1cc54b674@ssl
SSLCOMMERZ_SANDBOX=true
```

### Configuration File
The SSLCommerz configuration is located in `config/services.php`:

```php
'sslcommerz' => [
    'store_id' => env('SSLCOMMERZ_STORE_ID', 'cyber670e1cc54b674'),
    'store_password' => env('SSLCOMMERZ_STORE_PASSWORD', 'cyber670e1cc54b674@ssl'),
    'sandbox' => env('SSLCOMMERZ_SANDBOX', true),
],
```

## Database Schema

### Payments Table
The `payments` table stores all payment transactions:

```sql
- id (primary key)
- user_id (foreign key to users)
- course_id (foreign key to courses)
- transaction_id (unique identifier for SSLCommerz)
- session_key (SSLCommerz session key)
- amount (decimal, payment amount)
- currency (default: BDT)
- status (pending, success, failed, cancelled)
- payment_method (card type or payment method)
- response_data (JSON, full SSLCommerz response)
- paid_at (timestamp)
- created_at, updated_at
```

## Payment Flow

### 1. Course Enrollment
- Student browses available courses at `/student/courses/all`
- Clicks "Enroll Now" on a course
- System checks if course is free or paid

### 2. Free Course
- If course price (after discount) is ≤ 0
- User is enrolled immediately without payment
- Redirected to course view page

### 3. Paid Course
**Step 1: Payment Initiation**
- POST request to `/payment/initiate/{course}`
- Creates payment record with status 'pending'
- Sends request to SSLCommerz API
- User is redirected to SSLCommerz payment gateway

**Step 2: Payment Processing**
- User completes payment on SSLCommerz
- SSLCommerz redirects based on result:
  - Success → `/payment/success`
  - Failure → `/payment/fail`
  - Cancelled → `/payment/cancel`

**Step 3: Payment Validation**
- System validates payment with SSLCommerz
- Updates payment status
- Enrolls user in course if successful
- Stores payment method and transaction details

**Step 4: Confirmation**
- User redirected to confirmation page
- Shows transaction details and receipt
- Options to start learning or return to dashboard

## Routes

### Payment Routes
```php
POST   /payment/initiate/{course}        // Initiate payment
POST   /payment/success                  // Success callback
POST   /payment/fail                     // Fail callback
POST   /payment/cancel                   // Cancel callback
POST   /payment/ipn                      // Instant Payment Notification
GET    /payment/confirmation/{payment}   // View receipt
GET    /payment/history                  // Payment history
```

### Student Routes
```php
GET    /student/courses/all              // Browse all courses
GET    /student/courses/{course}/detail  // Course detail page
GET    /student/courses/{course}         // View enrolled course
```

## Key Files

### Services
- `app/Services/SSLCommerzService.php` - Main payment service

### Controllers
- `app/Http/Controllers/PaymentController.php` - Payment endpoints

### Models
- `app/Models/Payment.php` - Payment model
- `app/Models/User.php` - Added payments() relationship
- `app/Models/Course.php` - Added payments() relationship

### Views
- `resources/views/payment/confirmation.blade.php` - Payment success page
- `resources/views/payment/history.blade.php` - Payment history
- `resources/views/livewire/student/course-detail.blade.php` - Course detail with pricing
- `resources/views/livewire/student/all-courses.blade.php` - Course listing

### Migrations
- `database/migrations/2026_01_23_055442_create_payments_table.php`

## Features

### 1. Secure Payment Processing
- Direct integration with SSLCommerz API
- Payment validation before enrollment
- Transaction tracking and logging

### 2. Dynamic Pricing
- Regular price display
- Discount support with visual indicators
- Free course handling

### 3. User Experience
- Clean, modern UI with consistent design
- Mobile-responsive payment pages
- Real-time payment status updates
- Print receipt functionality

### 4. Payment History
- Complete transaction history
- Status indicators (success, pending, failed)
- View receipts for successful payments
- Searchable and filterable

### 5. Admin Features
- Track all payments through Payment model
- Monitor enrollment revenue
- Payment analytics ready

## Testing

### Sandbox Testing
The system is configured for sandbox mode by default.

**Test Cards:**
SSLCommerz provides test cards in sandbox mode. Refer to SSLCommerz documentation for test card numbers.

### Test Flow
1. Login as student
2. Browse courses at `/student/courses/all`
3. Click on a course to view details
4. Click "Enroll Now"
5. Complete payment on SSLCommerz sandbox
6. Verify enrollment and payment record

### Production Deployment
To enable live payments:
1. Update credentials in `.env`:
   ```env
   SSLCOMMERZ_STORE_ID=your_live_store_id
   SSLCOMMERZ_STORE_PASSWORD=your_live_password
   SSLCOMMERZ_SANDBOX=false
   ```
2. Clear config cache: `php artisan config:clear`
3. Test thoroughly before going live

## Security Considerations

1. **Payment Validation**: All payments are validated with SSLCommerz before enrollment
2. **User Authorization**: Users can only access their own payment records
3. **Secure Credentials**: Store credentials in `.env`, never in code
4. **HTTPS Required**: Always use HTTPS in production
5. **Transaction Logging**: All payment responses are logged for audit

## Troubleshooting

### Common Issues

**Payment not completing:**
- Check SSLCommerz credentials
- Verify callback URLs are accessible
- Check payment table for status

**Enrollment not happening:**
- Check payment validation logic
- Verify course_student pivot table
- Check user permissions

**Gateway errors:**
- Verify API connectivity
- Check sandbox vs production mode
- Review SSLCommerz dashboard

## Support

For SSLCommerz integration issues:
- SSLCommerz Documentation: https://developer.sslcommerz.com/
- Support: integration@sslcommerz.com

## Changelog

### v1.0.0 (2026-01-23)
- Initial SSLCommerz integration
- Payment tracking system
- Course enrollment with payment
- Payment history and receipts
- Sandbox and production support
