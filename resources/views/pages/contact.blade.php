@extends('layouts.base')

@section('content')
<main class="max-w-3xl mx-auto px-6 lg:px-8 py-16">
  <header class="mb-8 text-center">
    <h1 class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">Contact Us</h1>
    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">We're here to help — send us a message and we'll respond as soon as we can.</p>
  </header>

  <section>
    <form action="#" method="POST" class="space-y-4 bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input type="text" name="name" class="mt-1 block w-full rounded-md border border-emerald-200 dark:border-zinc-700 px-3 py-2 bg-white dark:bg-zinc-900 text-sm" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" name="email" class="mt-1 block w-full rounded-md border border-emerald-200 dark:border-zinc-700 px-3 py-2 bg-white dark:bg-zinc-900 text-sm" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
        <textarea name="message" rows="5" class="mt-1 block w-full rounded-md border border-emerald-200 dark:border-zinc-700 px-3 py-2 bg-white dark:bg-zinc-900 text-sm"></textarea>
      </div>
      <div class="text-right">
        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-semibold">Send Message</button>
      </div>
    </form>
  </section>
</main>
@endsection
