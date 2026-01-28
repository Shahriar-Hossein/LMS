@extends('layouts.base')

@section('title', 'Payment Failed')

@section('content')
<div class="max-w-3xl mx-auto my-12 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Payment Failed</h1>

    <div class="mb-4">
        <p class="text-red-700 font-medium">Unfortunately your payment could not be completed.</p>
    </div>

    @if(isset($payment))
        <div class="mb-4">
            <p><strong>Course:</strong> {{ $payment->course->title ?? '—' }}</p>
            <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        </div>
    @endif

    <div class="flex gap-3">
        <a href="{{ route('student.courses.all') }}" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded">Browse Courses</a>
        <a href="{{ route('student.courses.index') }}" class="inline-block px-4 py-2 border rounded">My Courses</a>
    </div>
</div>
@endsection
