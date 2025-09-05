<section id="" class="relative min-h-screen flex items-center bg-gradient-to-r from-emerald-200 via-cyan-200 to-emerald-300 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col-reverse md:flex-row items-center gap-12 py-20 w-full">

    <!-- Left Content -->
    <div class="flex-1 text-center md:text-left">
      <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6">
        Build or Upgrade Your Skills
      </h1>
      <p class="text-lg text-gray-700 dark:text-gray-300 mb-8 max-w-xl mx-auto md:mx-0">
        Welcome to <span class="font-semibold text-emerald-800 dark:text-emerald-400">SkillUp</span> —
        where there’s something for everyone, from students to working professionals.
      </p>

      <!-- CTA -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
        <a href="#"
          class="px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-cyan-600 text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
          Get Started
        </a>
        <a href="#categories"
          class="px-6 py-3 rounded-xl bg-white dark:bg-zinc-800 text-emerald-700 dark:text-emerald-400 font-semibold border border-emerald-200 dark:border-zinc-700 shadow hover:shadow-md hover:text-emerald-300 hover:bg-zinc-900 ring transition">
          Browse Categories
        </a>
      </div>

      <!-- Stats -->
      <div class="flex flex-wrap justify-center md:justify-start gap-6 mt-12 text-gray-800 dark:text-gray-200">
        <div class="flex items-center gap-3">
          <x-icons.icon-hat class="w-8 h-8 fill-emerald-600 dark:fill-emerald-400" />
          <span class="text-base">1M+ Students</span>
        </div>
        <div class="flex items-center gap-3">
          <x-icons.icon-course class="w-8 h-8 stroke-emerald-600 dark:stroke-emerald-400" />
          <span class="text-base">2K+ Courses</span>
        </div>
        <div class="flex items-center gap-3">
          <x-icons.icon-teacher class="w-8 h-8 fill-emerald-600 dark:fill-emerald-400" />
          <span class="text-base">20K+ Instructors</span>
        </div>
      </div>
    </div>

    <!-- Right Image -->
    <div class="flex-1 flex justify-center md:justify-end">
      <img src="{{ asset('images/study.png') }}"
           alt="Study illustration"
           class="w-full max-w-md md:max-w-lg drop-shadow-2xl rounded-2xl">
    </div>

  </div>
</section>
