<header class="bg-white/80 dark:bg-zinc-900/80 shadow-sm backdrop-blur-md
               px-6 py-4 flex justify-between items-center border-b
               border-emerald-100 dark:border-zinc-700">

    <h1 class="text-lg font-semibold text-cyan-700 dark:text-emerald-300">
        Dashboard
    </h1>

    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-700 dark:text-gray-300">
            Hello, {{ auth()->user()->name }}
        </span>
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
             alt="Avatar" class="w-9 h-9 rounded-full border-2 border-emerald-500">
    </div>
</header>
