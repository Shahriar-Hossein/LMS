# SSLCommerz Payment Integration - Visual Guide

## 🎨 User Interface Screenshots (Descriptions)

### 1. All Courses Page (`/student/courses/all`)
```
┌─────────────────────────────────────────────────────────┐
│  📚 All Courses                    My enrolled courses → │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ │
│  │ [Course Img] │  │ [Course Img] │  │ [Course Img] │ │
│  │  SAVE ৳500   │  │              │  │  SAVE ৳200   │ │
│  ├──────────────┤  ├──────────────┤  ├──────────────┤ │
│  │ Course Title │  │ Course Title │  │ Course Title │ │
│  │ Description  │  │ Description  │  │ Description  │ │
│  │              │  │              │  │              │ │
│  │ ৳1500  ৳2000 │  │    Free      │  │ ৳800   ৳1000 │ │
│  │ [Enroll Now] │  │ [Enroll Now] │  │ [Enrolled]   │ │
│  │              │  │              │  │              │ │
│  │ 5 Modules    │  │ 3 Modules    │  │ 8 Modules    │ │
│  │ Instructor   │  │ Instructor   │  │ Instructor   │ │
│  └──────────────┘  └──────────────┘  └──────────────┘ │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

### 2. Course Detail Page (`/student/courses/{slug}/detail`)
```
┌─────────────────────────────────────────────────────────────┐
│ ← Back                                                       │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ Course Title (Large, Gradient Background)               │ │
│ │ Description                                             │ │
│ │ 👤 Instructor | 🏷️ Category | 📚 5 Modules              │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                              │
│ ┌──────────────────────┐  ┌────────────────────┐          │
│ │  [Course Video/Img]  │  │  ৳1500  ৳2000     │          │
│ │                      │  │  Save ৳500!       │          │
│ └──────────────────────┘  │                    │          │
│                           │ [Enroll Now - Pay] │          │
│ ┌──────────────────────┐  │                    │          │
│ │ Course Curriculum    │  │ ✓ Lifetime access │          │
│ │                      │  │ ✓ 5 modules       │          │
│ │ ▶ Module 1: Intro   │  │ ✓ Certificate     │          │
│ │   - Lesson 1        │  │ ✓ Support         │          │
│ │   - Lesson 2        │  │                    │          │
│ │ ▶ Module 2: Advanced│  │ Powered by:       │          │
│ │   - Lesson 3        │  │ SSLCommerz        │          │
│ └──────────────────────┘  └────────────────────┘          │
└─────────────────────────────────────────────────────────────┘
```

### 3. Payment Confirmation Page (`/payment/confirmation/{id}`)
```
┌─────────────────────────────────────────────────────────┐
│           ✓ Payment Successful!                         │
│        Thank you for your enrollment                    │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  📄 Transaction Details                                 │
│  ┌────────────────────────────────────────────┐        │
│  │ Transaction ID:    TXN-1234567890          │        │
│  │ Amount Paid:       ৳1,500.00               │        │
│  │ Payment Method:    Visa Card               │        │
│  │ Date:             Jan 23, 2026 05:30 PM    │        │
│  └────────────────────────────────────────────┘        │
│                                                          │
│  📚 Course Details                                      │
│  ┌────────────────────────────────────────────┐        │
│  │ [Img] Laravel Complete Course              │        │
│  │       Master Laravel framework...          │        │
│  └────────────────────────────────────────────┘        │
│                                                          │
│  ┌──────────────────┐  ┌──────────────────┐           │
│  │ [Start Learning] │  │ [Go to Dashboard]│           │
│  └──────────────────┘  └──────────────────┘           │
│                                                          │
│              🖨️ Print Receipt                           │
└─────────────────────────────────────────────────────────┘
```

### 4. Payment History Page (`/payment/history`)
```
┌─────────────────────────────────────────────────────────────┐
│  Your Payment History                                        │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  Transaction ID  | Course        | Amount  | Status | Date  │
│  ───────────────────────────────────────────────────────────│
│  TXN-123456...   | Laravel       | ৳1,500  | ✓ Success     │
│                  |               |         | [View Receipt] │
│  ───────────────────────────────────────────────────────────│
│  TXN-789012...   | React Native  | ৳2,000  | ⏳ Pending    │
│                  |               |         |                │
│  ───────────────────────────────────────────────────────────│
│  TXN-345678...   | Python        | ৳800    | ✗ Failed      │
│                  |               |         |                │
│  ───────────────────────────────────────────────────────────│
│                                                              │
│                    « 1 2 3 »                                │
└─────────────────────────────────────────────────────────────┘
```

## 🔄 Payment Flow Diagram

```
┌─────────────┐
│   Student   │
│  Dashboard  │
└──────┬──────┘
       │
       ↓
┌─────────────────┐
│ Browse Courses  │ ← /student/courses/all
│  (Grid View)    │   Shows pricing, discounts
└──────┬──────────┘
       │
       ↓
┌─────────────────┐
│ Course Detail   │ ← /student/courses/{slug}/detail
│   (Full Info)   │   Pricing breakdown, modules
└──────┬──────────┘
       │
       ↓ [Click Enroll Now]
       │
┌──────┴──────┐
│ Check Price │
└──────┬──────┘
       │
    ┌──┴──┐
    │     │
    ↓     ↓
  Free   Paid
    │     │
    │     ↓
    │  ┌──────────────────┐
    │  │ POST /payment/   │
    │  │  initiate        │
    │  └────────┬─────────┘
    │           │
    │           ↓
    │  ┌──────────────────┐
    │  │ Create Payment   │
    │  │   Record         │
    │  │ (status=pending) │
    │  └────────┬─────────┘
    │           │
    │           ↓
    │  ┌──────────────────┐
    │  │  SSLCommerz      │
    │  │  Payment Gateway │
    │  └────────┬─────────┘
    │           │
    │     ┌─────┴─────┬──────────┐
    │     ↓           ↓          ↓
    │  Success      Failed    Cancelled
    │     │           │          │
    │     ↓           ↓          ↓
    │  ┌──────────────────────────┐
    │  │   Validate Payment       │
    │  │  (with SSLCommerz)       │
    │  └────────┬─────────────────┘
    │           │
    │           ↓ [If Valid]
    │  ┌──────────────────┐
    │  │ Update Payment   │
    │  │ (status=success) │
    │  └────────┬─────────┘
    │           │
    ↓           ↓
┌───────────────────────┐
│ Enroll Student        │
│ in Course             │
│ (course_student)      │
└──────────┬────────────┘
           │
           ↓
┌──────────────────────┐
│ Confirmation Page    │ ← /payment/confirmation/{id}
│ Show Receipt         │   Transaction details
└──────────────────────┘
```

## 🗄️ Database Schema Relationships

```
┌─────────────┐         ┌─────────────┐
│    users    │         │   courses   │
│─────────────│         │─────────────│
│ id          │         │ id          │
│ name        │         │ title       │
│ email       │         │ slug        │
│ ...         │         │ price       │
└──────┬──────┘         │ discount    │
       │                │ ...         │
       │                └──────┬──────┘
       │                       │
       │    ┌──────────────────┴────────────┐
       │    │                                │
       ↓    ↓                                ↓
┌──────────────────┐               ┌─────────────┐
│ course_student   │               │  payments   │
│──────────────────│               │─────────────│
│ id               │               │ id          │
│ user_id      ────┼───────────────│ user_id     │
│ course_id    ────┼───────────────│ course_id   │
│ price_paid       │               │ transaction │
│ progress         │               │ amount      │
│ completed_at     │               │ status      │
│ timestamps       │               │ paid_at     │
└──────────────────┘               │ ...         │
                                   └─────────────┘
```

## 📱 Navigation Structure

```
Student Sidebar
├── Dashboard
├── Courses (My Enrolled)
├── Browse Courses ← NEW
├── Payment History ← NEW
├── Profile
└── Password
```

## 🎯 Status Flow

```
Payment Status Transitions:

pending → success → [Enrollment Confirmed]
         ↓
        failed → [No Enrollment]
         ↓
      cancelled → [No Enrollment]
```

## 🔐 Security Layers

```
┌─────────────────────────────────────┐
│      User Authentication            │ ← Laravel Auth
├─────────────────────────────────────┤
│     Route Middleware (auth)         │ ← routes/web.php
├─────────────────────────────────────┤
│   Authorization Checks              │ ← Controller
├─────────────────────────────────────┤
│  Payment Validation                 │ ← SSLCommerzService
├─────────────────────────────────────┤
│  Transaction Verification           │ ← SSLCommerz API
├─────────────────────────────────────┤
│    Database Constraints             │ ← Migrations
└─────────────────────────────────────┘
```

## 💰 Price Calculation

```
Original Price:    ৳2000
Discount:         -৳ 500
─────────────────────────
Final Price:       ৳1500  ← Amount charged

If Final Price ≤ 0 → FREE (no payment required)
If Final Price > 0  → PAID (SSLCommerz gateway)
```

## 🎨 Color Scheme

```
Primary Colors:
- Emerald: #10b981 (Green accents)
- Cyan:    #06b6d4 (Blue accents)
- Gradient: emerald-600 to cyan-600

Status Colors:
- Success:  Green   (#10b981)
- Pending:  Yellow  (#eab308)
- Failed:   Red     (#ef4444)
- Info:     Blue    (#3b82f6)

Backgrounds:
- Light:    white/80 with backdrop-blur
- Dark:     zinc-900/80 with backdrop-blur
- Borders:  emerald-100 / zinc-700
```

## 📝 Key Endpoints Summary

| Method | Endpoint                      | Purpose                    |
|--------|-------------------------------|----------------------------|
| GET    | /student/courses/all          | Browse courses             |
| GET    | /student/courses/{slug}/detail| Course details + pricing   |
| POST   | /payment/initiate/{course}    | Start payment              |
| POST   | /payment/success              | Payment success callback   |
| POST   | /payment/fail                 | Payment fail callback      |
| POST   | /payment/cancel               | Payment cancel callback    |
| POST   | /payment/ipn                  | Instant notification       |
| GET    | /payment/confirmation/{id}    | View receipt               |
| GET    | /payment/history              | Transaction history        |

---

**Visual guide complete!** 🎨

This diagram shows how all components work together.
