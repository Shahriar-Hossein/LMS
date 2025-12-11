<aside class="w-64 bg-white/80 dark:bg-zinc-900/80 border-r border-emerald-100 dark:border-zinc-700
              shadow-xl backdrop-blur-md h-screen flex flex-col">

    <!-- Branding -->
    <div class="p-6 flex items-center justify-center border-b border-emerald-100 dark:border-zinc-700">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-2">
            <x-app-logo-icon class="size-10 text-emerald-600 dark:text-emerald-400" />
            <span class="font-semibold text-emerald-700 dark:text-emerald-300">Instructor</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('instructor.dashboard') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium text-emerald-700 dark:text-emerald-300
                  hover:bg-emerald-50 dark:hover:bg-zinc-800">
            Dashboard
        </a>
        <a href="{{ route('instructor.courses.index') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium text-emerald-700 dark:text-emerald-300
                  hover:bg-emerald-50 dark:hover:bg-zinc-800">
            Courses
        </a>
        <a href="{{ route('instructor.students.index') }}"
            class="block px-3 py-2 rounded-md text-sm font-medium text-emerald-700 dark:text-emerald-300
                  hover:bg-emerald-50 dark:hover:bg-zinc-800">
            Students
        </a>
        <a href="{{ route('instructor.settings.profile') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium text-emerald-700 dark:text-emerald-300
                  hover:bg-emerald-50 dark:hover:bg-zinc-800">
            Profile
        </a>
    </nav>
</aside>
