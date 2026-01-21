@extends('layouts.base')

@section('content')
<main class="max-w-5xl mx-auto px-6 lg:px-8 py-16">
  <header class="mb-8">
    <h1 class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">Help Center</h1>
    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Find guides, troubleshooting tips, and ways to contact support.</p>
  </header>

  <section class="space-y-6">
    <div>
      <h3 class="text-lg font-semibold">Getting Started</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">Browse courses, create an account, and start learning in minutes.</p>
    </div>

    <div>
      <h3 class="text-lg font-semibold">Billing & Payments</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">See billing FAQs and how to manage subscriptions or invoices.</p>
    </div>

    <div>
      <h3 class="text-lg font-semibold">Report a Problem</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">If you encounter issues, contact support via the Contact page.</p>
    </div>
  </section>
</main>
@endsection
