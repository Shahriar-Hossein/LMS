@extends('layouts.base')

@section('content')
<main class="max-w-6xl mx-auto px-6 lg:px-8 py-20 text-base leading-relaxed">
  <!-- About header and platform overview -->
  <header class="text-center mb-12">
    <p class="inline-block text-sm font-semibold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1 rounded-full">About SkillUp</p>
    <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white">We help learners gain practical skills and meaningful outcomes</h1>
    <p class="mt-4 max-w-3xl mx-auto text-lg text-gray-600 dark:text-gray-300">SkillUp is a learner-first platform offering curated, project-based courses built with industry needs in mind. We empower novice and experienced instructors to create, publish, and monetize any course — from foundational CSE topics to advanced specializations. We combine mentorship, hands-on assessments, and employer-aligned outcomes so learners build demonstrable skills employers trust.</p>
  </header>

  <!-- General information: pillars -->
  <section class="grid gap-6 sm:grid-cols-3 mb-12">
    <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
      <h3 class="text-xl font-semibold text-emerald-700">Our Mission</h3>
      <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Make high-quality, career-focused education accessible and effective for everyone, while creating sustainable earning opportunities for instructors.</p>
    </div>

    <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
      <h3 class="text-xl font-semibold text-emerald-700">How we teach</h3>
      <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Project-first curriculum, mentor feedback, and assessments that map to real job skills. Instructors receive tools and guidance to build market-ready courses.</p>
    </div>

    <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
      <h3 class="text-xl font-semibold text-emerald-700">Teach & Earn</h3>
      <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Any instructor — even novices — can create and sell courses here. We provide monetization, analytics, and marketing support. CSE-related courses (programming, algorithms, systems) are a platform focus due to high learner demand.</p>
    </div>
  </section>

  <!-- Leadership -->
  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Leadership</h2>
    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Our leadership combines product, curriculum, and industry expertise to deliver measurable learner outcomes.</p>

    <div class="mt-6 grid gap-6 sm:grid-cols-3">
      <div class="p-8 bg-white dark:bg-gray-900 rounded-lg shadow-md text-center">
        <div class="mx-auto h-28 w-28 rounded-full bg-emerald-600 text-white flex items-center justify-center font-semibold text-xl">AL</div>
        <div class="mt-4 text-xl font-semibold">Alicia Lopez</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Chief Executive Officer</div>
        <p class="mt-3 text-base text-gray-600 dark:text-gray-300">Product and company builder focused on learner growth, instructor enablement, and partnerships.</p>
      </div>

      <div class="p-8 bg-white dark:bg-gray-900 rounded-lg shadow-md text-center">
        <div class="mx-auto h-28 w-28 rounded-full bg-emerald-500 text-white flex items-center justify-center font-semibold text-xl">JM</div>
        <div class="mt-4 text-xl font-semibold">Jonah Mills</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Head of Curriculum</div>
        <p class="mt-3 text-base text-gray-600 dark:text-gray-300">Designs employer-aligned programs, mentors instructors, and builds curriculum tooling for novice creators.</p>
      </div>

      <div class="p-8 bg-white dark:bg-gray-900 rounded-lg shadow-md text-center">
        <div class="mx-auto h-28 w-28 rounded-full bg-emerald-700 text-white flex items-center justify-center font-semibold text-xl">SR</div>
        <div class="mt-4 text-xl font-semibold">Sana Rahman</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">VP, Partnerships</div>
        <p class="mt-3 text-base text-gray-600 dark:text-gray-300">Builds industry relationships and employer advisory boards to keep curriculum current and hire-ready.</p>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Team</h2>

    <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Cross-functional team of designers, engineers, curriculum experts, and learner success coaches.</p>

    <div class="mt-6 grid gap-6 sm:grid-cols-3 lg:grid-cols-6">
      @foreach(['AL','JM','SR','KP','MN','TC'] as $initial)
      <div class="text-center p-4 bg-white dark:bg-gray-900 rounded-lg shadow-sm">
        <div class="mx-auto h-20 w-20 rounded-full bg-emerald-600 text-white flex items-center justify-center font-semibold text-xl">{{ $initial }}</div>
        <div class="mt-3 text-base font-medium">{{ $initial }} Name</div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Role</div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Testimonials -->
  <section>
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">What learners say</h2>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Real feedback from learners who used SkillUp to advance their careers.</p>

    <div class="mt-6 grid gap-6 sm:grid-cols-3">
      <blockquote class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-800">
        <p class="text-base text-gray-800 dark:text-gray-100">“SkillUp's projects helped me land my first developer role. The instructors are industry pros.”</p>
        <footer class="mt-4 text-sm text-gray-500 dark:text-gray-400">— Priya K., Frontend Engineer</footer>
      </blockquote>

      <blockquote class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-800">
        <p class="text-base text-gray-800 dark:text-gray-100">“Practical, concise, and employer-focused—exactly what I needed to switch careers.”</p>
        <footer class="mt-4 text-sm text-gray-500 dark:text-gray-400">— Marco T., Data Analyst</footer>
      </blockquote>

      <blockquote class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-800">
        <p class="text-base text-gray-800 dark:text-gray-100">“Hands-on projects, meaningful feedback, and a supportive community.”</p>
        <footer class="mt-4 text-sm text-gray-500 dark:text-gray-400">— Jenna R., Product Designer</footer>
      </blockquote>
    </div>
  </section>
</main>
@endsection
