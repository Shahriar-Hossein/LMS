<nav class="relative flex w-full flex-wrap items-center justify-between py-3 shadow-md bg-gradient-to-r from-emerald-300 via-cyan-200 to-emerald-200 dark:bg-gradient-to-r dark:from-zinc-800 dark:via-zinc-900 dark:to-zinc-800 dark:text-white">
  <div class="flex w-full flex-wrap items-center justify-between px-6">

    <!-- Logo -->
    <div class="">
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="https://tecdn.b-cdn.net/img/logo/te-transparent-noshadows.webp" class="h-6" alt="SkillUp Logo" />
        <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">SkillUp</span>
      </a>
    </div>

    <!-- Hamburger button -->
    <button class="block lg:hidden text-gray-600 dark:text-white focus:outline-none" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Desktop Menu -->
    <div class="hidden w-full lg:flex lg:items-center lg:w-auto mt-4 lg:mt-0" id="desktop-nav">
      <ul class="flex flex-col lg:flex-row lg:space-x-6 text-sm text-gray-700 dark:text-white font-medium">
        <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Home</a></li>
        <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Courses</a></li>
        <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">About</a></li>
        <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Contact</a></li>
      </ul>
    </div>

    <!-- Desktop Action Buttons -->
    <div class="hidden lg:flex items-center space-x-3">
      <a href="/login"
        class="text-cyan-600 dark:text-cyan-400 border border-cyan-600 dark:border-cyan-400 hover:bg-cyan-600 dark:hover:bg-cyan-500 hover:text-white transition px-4 py-2 rounded-md text-sm">
        Login
      </a>
      <a href="/register"
        class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-4 py-2 rounded-md text-sm shadow-md transition">
        Join For Free
      </a>
    </div>
  </div>

  <!-- Mobile Menu (Nav Links + Actions) -->
  <div class="lg:hidden hidden px-6 mt-4 flex flex-col gap-2 text-gray-700 dark:text-white" id="mobile-nav">
    <ul class="flex flex-col gap-2 text-sm font-medium">
      <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Home</a></li>
      <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Courses</a></li>
      <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">About</a></li>
      <li><a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400">Contact</a></li>
    </ul>

    <a href="/login"
      class="text-cyan-600 dark:text-cyan-400 border border-cyan-600 dark:border-cyan-400 hover:bg-cyan-600 dark:hover:bg-cyan-500 hover:text-white transition px-4 py-2 rounded-md text-sm text-center">
      Login
    </a>
    <a href="/register"
      class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-4 py-2 rounded-md text-sm text-center shadow-md transition">
      Join For Free
    </a>
  </div>
</nav>
