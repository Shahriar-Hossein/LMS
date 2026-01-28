@extends('layouts.base')

@section('content')
<main class="max-w-5xl mx-auto px-6 lg:px-8 py-16 text-gray-800 dark:text-gray-200">
  <header class="mb-8">
    <h1 class="text-4xl md:text-5xl font-extrabold text-emerald-700 dark:text-emerald-400">Help Center</h1>
    <p class="mt-3 text-lg md:text-xl text-gray-700 dark:text-gray-300 leading-relaxed max-w-3xl">Find clear guides, troubleshooting tips, and easy ways to contact support.</p>
  </header>

  <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <article class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-6 shadow-sm">
      <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">Getting Started</h3>
      <p class="mt-2 text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">Browse courses, create an account, and start learning in minutes. We recommend beginning with our "Introduction" modules to get familiar with the platform.</p>
    </article>

    <article class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-6 shadow-sm">
      <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">Billing & Payments</h3>
      <p class="mt-2 text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">See billing FAQs, how to update payment methods, and manage subscriptions or invoices. For receipts, visit your billing settings.</p>
    </article>

    <article class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-6 shadow-sm">
      <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">Report a Problem</h3>
      <p class="mt-2 text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">If you encounter issues, please contact our support team with a brief description and screenshots where possible. We aim to respond within 24–48 hours.</p>
      <a href="/contact" class="inline-block mt-4 px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">Contact Support</a>
    </article>

    <article class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-lg p-6 shadow-sm">
      <h3 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">Need More Help?</h3>
      <p class="mt-2 text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">Browse our knowledge base, view video walkthroughs, or reach out to your instructor for course-specific questions.</p>
    </article>
  </section>
</main>
@endsection
