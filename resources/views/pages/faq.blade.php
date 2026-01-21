@extends('layouts.base')

@section('content')
<main class="max-w-5xl mx-auto px-6 lg:px-8 py-16">
  <header class="mb-8">
    <h1 class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">Frequently Asked Questions</h1>
    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Common questions about courses, accounts, and payments.</p>
  </header>

  <section class="space-y-6">
    <div>
      <h3 class="text-lg font-semibold">How do I enroll in a course?</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">Visit a course page and click the enroll button. Some courses may require approval from the instructor.</p>
    </div>

    <div>
      <h3 class="text-lg font-semibold">Can I get a refund?</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">Refunds depend on the course and instructor policies. Check the course details or contact support.</p>
    </div>

    <div>
      <h3 class="text-lg font-semibold">How do I become an instructor?</h3>
      <p class="text-sm text-gray-700 dark:text-gray-300">Apply via the Become an Instructor link. Our team will review your application and guide you through onboarding.</p>
    </div>
  </section>
</main>
@endsection
