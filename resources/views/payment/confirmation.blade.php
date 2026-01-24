@extends('layouts.base')
@section('title', 'Payment Confirmation')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <style>
                @media print {
                    /* hide everything by default, reveal the printable area */
                    body * { visibility: hidden !important; }
                    #printable-area, #printable-area * { visibility: visible !important; }
                    /* keep page layout, and request exact color printing where supported */
                    #printable-area {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                        -webkit-print-color-adjust: exact !important;
                        print-color-adjust: exact !important;
                        page-break-inside: avoid;
                    }
                    /* ensure children request color adjustments but do not force inheritance */
                    #printable-area * {
                        -webkit-print-color-adjust: exact !important;
                        print-color-adjust: exact !important;
                    }
                    /* hide interactive/action elements */
                    .no-print { display: none !important; }
                    /* force single A4 page with small margins */
                    @page { size: A4; margin: 10mm; }
                    html, body { height: auto; }

                    /* If the site is in dark mode, force dark backgrounds/colors for print */
                    html.dark #printable-area {
                        background: #071024 !important;
                        color: #e6eef6 !important;
                    }
                    html.dark #printable-area .bg-gradient-to-r {
                        background: linear-gradient(to right,#064e3b,#047b7a) !important;
                        color: #ffffff !important;
                    }
                    html.dark #printable-area .bg-gray-50 {
                        background-color: #0f1724 !important;
                        color: #cbd5e1 !important;
                    }
                    html.dark #printable-area .from-emerald-600,
                    html.dark #printable-area .text-emerald-600 {
                        color: #34d399 !important;
                    }
                    html.dark #printable-area svg { color: inherit; stroke: currentColor; }
                }
            </style>
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 overflow-hidden">
                <div id="printable-area">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-cyan-500 p-8 text-white text-center">
                    <div class="flex justify-center mb-4">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Payment Successful!</h1>
                    <p class="text-emerald-100">Thank you for your enrollment</p>
                </div>

                <!-- Payment Details -->
                <div class="p-8">
                    <div class="space-y-6">
                        <!-- Transaction Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Transaction Details
                            </h3>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Transaction ID:</span>
                                    <span class="font-mono font-medium text-gray-900 dark:text-gray-100">{{ $payment->transaction_id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Amount Paid:</span>
                                    <span class="font-semibold text-emerald-600 dark:text-emerald-400">৳{{ number_format($payment->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Payment Method:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->payment_method ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Date:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $payment->paid_at->format('F d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Course Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Course Details
                            </h3>
                            <div class="flex items-start gap-4 bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                @if($payment->course->banner_path)
                                    <img src="{{ asset('storage/'.$payment->course->banner_path) }}" 
                                         alt="{{ $payment->course->title }}" 
                                         class="w-32 h-20 object-cover rounded-lg">
                                @else
                                    <div class="w-32 h-20 bg-gradient-to-br from-emerald-100 to-cyan-100 dark:from-emerald-900 dark:to-cyan-900 rounded-lg flex items-center justify-center">
                                        <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $payment->course->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($payment->course->description, 100) }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Action Buttons (do not print) -->
                <div class="flex flex-col sm:flex-row gap-3 py-4 mx-4 no-print">
                    <a href="{{ route('student.courses.view', $payment->course) }}" 
                       class="flex-1 bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-all duration-200 shadow-lg hover:shadow-xl">
                        Start Learning
                    </a>
                    <a href="{{ route('student.dashboard') }}" 
                       class="flex-1 bg-white dark:bg-zinc-800 border-2 border-emerald-600 dark:border-emerald-500 text-emerald-600 dark:text-emerald-400 font-semibold py-3 px-6 rounded-lg text-center hover:bg-emerald-50 dark:hover:bg-zinc-700 transition-all duration-200">
                        Go to Dashboard
                    </a>
                </div>

                <!-- Download Receipt (do not print) -->
                <div class="text-center py-4 border-t border-gray-200 dark:border-zinc-700 no-print">
                    <button onclick="window.print()" class="cursor-pointer text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Receipt
                    </button>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
