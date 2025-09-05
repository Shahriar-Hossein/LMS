<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
@extends('layouts.base')

@section('content')
<section class="bg-emerald-50 dark:bg-zinc-900 py-16">
  <div class="container mx-auto px-6 lg:px-20">

    <!-- Course Banner -->
    <div class="w-full rounded-lg overflow-hidden mb-8 shadow-md">
      <img src="{{ $course->banner_path ? asset('storage/' . $course->banner_path) : asset('images/default-course.png') }}"
           alt="{{ $course->title }}"
           class="w-full h-64 object-cover md:h-96">
    </div>

    <!-- Course Header -->
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-8">

      <!-- Left Column: Course Details -->
      <div class="lg:w-3/5 flex flex-col gap-6">

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
          {{ $course->title }}
        </h1>

        <!-- Instructor Info -->
        <div class="flex items-center gap-4">
          <img src="{{ $course->instructor->profile_photo_path ?? asset('images/default-avatar.png') }}"
               alt="{{ $course->instructor->name }}"
               class="w-12 h-12 rounded-full object-cover">
          <div class="flex flex-col">
            <span class="text-gray-900 dark:text-white font-semibold">{{ $course->instructor->name }}</span>
            <span class="text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($course->instructor->role ?? 'Instructor') }}</span>
          </div>
        </div>

        <!-- Course Description -->
        <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
          {{ $course->description }}
        </p>

        <!-- Course Meta -->
        <div class="flex flex-wrap gap-6 text-gray-700 dark:text-gray-300">
          <div class="flex items-center gap-2">
            <x-icons.icon-hat class="w-5 h-5 fill-emerald-600 dark:fill-emerald-400"/>
            <span>{{ $course->students_count ?? 0 }} enrolled</span>
          </div>
          <div class="flex items-center gap-2">
            <x-icons.icon-course class="w-5 h-5 stroke-emerald-600 dark:stroke-emerald-400"/>
            <span>{{ $course->modules_count ?? 0 }} modules</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 fill-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.4 11.545 1 7.91l6.06-.545L10 2.5l2.94 4.865L19 7.91l-4.4 3.636 1.278 6.545z"/></svg>
            <span>4.5 (120 reviews)</span>
          </div>
        </div>

      </div>

      <!-- Right Column: Pricing & Enroll -->
      <div class="lg:w-2/5 flex flex-col gap-6">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-6 flex flex-col gap-4">

          <!-- Price -->
          <div class="flex items-center gap-2 text-lg md:text-xl font-semibold">
            @if($course->discount > 0)
              <span class="line-through text-gray-400 dark:text-gray-500">{{ $course->price ?? 'Free' }} tk</span>
              <span class="text-emerald-600 dark:text-emerald-400">{{ $course->price - ($course->price * $course->discount / 100) }} tk</span>
            @else
              <span class="text-emerald-600 dark:text-emerald-400">{{ $course->price ?? 'Free' }} tk</span>
            @endif
          </div>

          <!-- Enroll Button -->
          <a href="#"
             class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-6 py-3 rounded-md text-center font-semibold shadow transition">
            Enroll Now
          </a>

          <!-- Optional Additional Info -->
          <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">
            Lifetime access · Certificate of completion · Access on mobile and TV
          </div>
        </div>
      </div>
    </div>

    <!-- Course Content / Modules -->
    <div class="mt-12">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Course Modules</h2>
      <ul class="space-y-3">
        @foreach($course->modules ?? [] as $module)
          <li class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-4 flex justify-between items-center">
            <span>{{ $module->title }}</span>
            <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $module->duration ?? '10m' }}</span>
          </li>
        @endforeach
      </ul>
    </div>

  </div>
</section>
@endsection
