# Quick Setup Guide - SSLCommerz Payment Integration

## 🚀 Quick Start

### Step 1: Environment Configuration
Add these lines to your `.env` file:

```env
# SSLCommerz Payment Gateway
SSLCOMMERZ_STORE_ID=cyber670e1cc54b674
SSLCOMMERZ_STORE_PASSWORD=cyber670e1cc54b674@ssl
SSLCOMMERZ_SANDBOX=true
```

### Step 2: Database Migration
The migration has already been run. If you need to run it again:

```bash
php artisan migrate
```

### Step 3: Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### Step 4: Start Development Server
```bash
php artisan serve
```

## 🧪 Testing the Integration

### Test as Student User

1. **Login**
   - Navigate to your application
   - Login with student credentials

2. **Browse Courses**
   - Go to: `/student/courses/all`
   - Or click "Browse Courses" in sidebar

3. **View Course Details**
   - Click on any course card
   - View pricing, modules, and course information

4. **Test Free Course Enrollment**
   - Create a test course with:
     - Price: 0 (or Price - Discount = 0)
   - Click "Enroll for Free"
   - Should enroll immediately
   - Check "My Courses" to verify

5. **Test Paid Course Enrollment**
   - Create a course with price > 0
   - Click "Enroll Now - Pay ৳XXX"
   - Redirected to SSLCommerz sandbox gateway
   - Use test cards (refer to SSLCommerz docs)
   - Complete payment
   - Should redirect to confirmation page
   - Verify enrollment in "My Courses"

6. **View Payment History**
   - Go to: `/payment/history`
   - Or click "Payment History" in sidebar
   - See all your transactions

## 📋 Available Routes

### Student Routes
- `/student/courses/all` - Browse all courses
- `/student/courses/{slug}/detail` - Course detail page
- `/student/courses/{slug}` - Enrolled course view
- `/student/courses` - My enrolled courses

### Payment Routes
- `POST /payment/initiate/{course}` - Start payment
- `POST /payment/success` - Payment success callback
- `POST /payment/fail` - Payment fail callback
- `POST /payment/cancel` - Payment cancel callback
- `POST /payment/ipn` - Instant Payment Notification
- `GET /payment/confirmation/{id}` - View receipt
- `GET /payment/history` - Payment history

## 🎨 UI Components Created

1. **Course Cards** - Grid layout with pricing
2. **Course Detail Page** - Full course information with enrollment
3. **Payment Confirmation** - Beautiful success page
4. **Payment History** - Transaction list with filters
5. **Navigation Links** - Added to student sidebar

## 🔧 Key Features

### Payment Processing
- ✅ Automatic free course detection
- ✅ SSLCommerz gateway integration
- ✅ Payment validation
- ✅ Transaction tracking
- ✅ Multi-status support

### User Experience
- ✅ Responsive design
- ✅ Dark mode support
- ✅ Discount display
- ✅ Course pricing
- ✅ Receipt printing
- ✅ Payment history

### Security
- ✅ Authentication required
- ✅ Payment validation
- ✅ User authorization
- ✅ Transaction logging

## 📊 Database Tables

### payments
- Stores all payment transactions
- Links to users and courses
- Tracks status and payment details

### course_student (existing)
- Now includes `price_paid` field
- Updated during enrollment

## 🎯 How It Works

1. **Student browses courses** → See pricing and discounts
2. **Clicks "Enroll Now"** → System checks if free or paid
3. **Free Course** → Enrolled immediately
4. **Paid Course** → Redirected to SSLCommerz
5. **Payment Complete** → Validation & Enrollment
6. **Confirmation** → Receipt & course access

## 🐛 Troubleshooting

### Payment not initiating?
- Check `.env` credentials
- Verify `config:clear` was run
- Check browser console for errors

### Gateway not loading?
- Verify internet connection
- Check SSLCommerz credentials
- Ensure sandbox mode is enabled

### Enrollment not happening?
- Check payment status in database
- Verify payment validation logic
- Check `course_student` pivot table

## 📚 Documentation Files

- `PAYMENT_INTEGRATION.md` - Complete technical documentation
- `IMPLEMENTATION_SUMMARY.md` - What was implemented
- `QUICK_SETUP.md` - This file

## 🔐 Production Checklist

Before going live:
- [ ] Get production credentials from SSLCommerz
- [ ] Update `.env` with live credentials
- [ ] Set `SSLCOMMERZ_SANDBOX=false`
- [ ] Test with real small amount
- [ ] Enable HTTPS (required)
- [ ] Review security settings
- [ ] Set up error monitoring
- [ ] Test all callbacks
- [ ] Verify IPN endpoint

## 💡 Tips

1. **Sandbox Testing**: SSLCommerz provides test cards for sandbox
2. **Callback URLs**: Must be publicly accessible for live mode
3. **Transaction ID**: Unique for each payment attempt
4. **Status Codes**: pending → success/failed/cancelled
5. **Price Display**: Shows discount prominently

## 📞 Support

- SSLCommerz Docs: https://developer.sslcommerz.com/
- SSLCommerz Support: integration@sslcommerz.com

---

**Ready to test!** 🎉

Start your server and login as a student to test the payment flow.
