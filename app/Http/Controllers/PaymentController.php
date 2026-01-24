<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Services\SSLCommerzService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected SSLCommerzService $sslCommerz;

    public function __construct(SSLCommerzService $sslCommerz)
    {
        $this->sslCommerz = $sslCommerz;
    }

    /**
     * Initiate payment for course enrollment
     */
    public function initiate(Course $course)
    {
        $user = Auth::user();

        // Check if user is already enrolled
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.courses.view', $course)
                ->with('info', 'You are already enrolled in this course.');
        }

        // Check if course is free (discount is percentage)
        $price = floatval($course->price);
        $discountPercent = floatval($course->discount ?? 0);
        $discountAmount = ($discountPercent > 0) ? ($price * ($discountPercent / 100)) : 0;
        $finalPrice = max(0, $price - $discountAmount);

        if ($finalPrice <= 0) {
            // Free course, enroll directly
            $user->courses()->attach($course->id, [
                'price_paid' => 0,
                'progress' => 0,
            ]);
            
            return redirect()->route('student.courses.view', $course)
                ->with('success', 'Successfully enrolled in the course!');
        }

        // Initiate payment for paid course
        $result = $this->sslCommerz->initiatePayment($course, $user);

        if ($result['success']) {
            return redirect($result['gateway_url']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Payment success callback
     */
    public function success(Request $request)
    {
        $result = $this->sslCommerz->processSuccess($request->all());

        if ($result['success']) {
            $payment = $result['payment'];
            $course = $payment->course;

            // Ensure enrollment is recorded (idempotent)
            $user = $payment->user;
            if ($user && $course) {
                if (! $user->courses()->where('course_id', $course->id)->exists()) {
                    $user->courses()->attach($course->id, [
                        'price_paid' => $payment->amount,
                        'progress' => 0,
                    ]);
                }
            }

            return redirect()->route('payment.confirmation', $payment->id)
                ->with('success', 'Payment successful! You are now enrolled in the course.');
        }

        return redirect()->route('student.dashboard')
            ->with('error', $result['message'] ?? 'Payment verification failed.');
    }

    /**
     * Payment fail callback
     */
    public function fail(Request $request)
    {
        $result = $this->sslCommerz->processFail($request->all());
        $payment = $result['payment'] ?? null;
        // Redirect user to a friendly failure page (authenticated)
        if ($payment) {
            return redirect()->route('payment.failed', $payment->id);
        }

        return redirect()->route('payment.failed');
    }

    /**
     * Payment cancel callback
     */
    public function cancel(Request $request)
    {
        $result = $this->sslCommerz->processCancel($request->all());
        $payment = $result['payment'] ?? null;
        // Treat cancellation like a failure for the student-facing flow
        if ($payment) {
            return redirect()->route('payment.failed', $payment->id)
                ->with('info', 'Payment cancelled.');
        }

        return redirect()->route('payment.failed')->with('info', 'Payment cancelled.');
    }

    /**
     * IPN (Instant Payment Notification) callback
     */
    public function ipn(Request $request)
    {
        // Process IPN silently in background
        $this->sslCommerz->processSuccess($request->all());
        
        return response()->json(['status' => 'OK']);
    }

    /**
     * Show payment confirmation page
     */
    public function confirmation(Payment $payment)
    {
        // Ensure the payment belongs to the authenticated user
        if ($payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to payment details.');
        }

        return view('payment.confirmation', compact('payment'));
    }

    /**
     * Show payment failed/cancelled page
     */
    public function failed(Payment $payment = null)
    {
        // If a payment is provided, ensure it belongs to the user
        if ($payment && $payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to payment details.');
        }

        return view('payment.failed', compact('payment'));
    }

    /**
     * Show payment history
     */
    public function history()
    {
        $payments = Auth::user()->payments()->with('course')->latest()->paginate(10);
        
        return view('payment.history', compact('payments'));
    }
}
