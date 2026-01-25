<div class="flex gap-8">
    <div class="flex-1 space-y-6">
        <h2 class="text-2xl font-bold text-cyan-700 dark:text-emerald-300">Admin Dashboard</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Courses</h3>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $courses }}</p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Students</h3>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $students }}</p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Instructors</h3>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $instructors }}</p>
            </div>

            <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
                <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Revenue</h3>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">৳{{ number_format($revenue, 2) }}</p>
            </div>
        </div>
    </div>
</div>
