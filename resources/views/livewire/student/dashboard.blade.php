<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold text-cyan-700 dark:text-emerald-300 mb-4">Student Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
            <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Enrolled</h3>
            <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $enrolledCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
            <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Spent</h3>
            <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">${{ number_format($totalSpent ?? 0, 2) }}</p>
        </div>

        <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
            <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Overall Progress</h3>
            <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $overallProgress ?? 0 }}%</p>
        </div>

        <div class="p-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
            <h3 class="text-sm font-medium text-gray-600 dark:text-gray-300">Completed Courses</h3>
            <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $completed ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700">
        <div class="border-b p-3 flex items-center gap-4">
            <a href="#tab-courses" class="text-sm font-medium">Enrolled Courses</a>
            <a href="#tab-profile" class="text-sm font-medium">Profile</a>
            <a href="#tab-assignments" class="text-sm font-medium">Pending Assignments</a>
        </div>

        <div id="tab-courses" class="p-4">
            <h2 class="font-semibold mb-3">My Enrolled Courses</h2>
            @if(empty($courses) || $courses->isEmpty())
                <div class="text-gray-500">You are not enrolled in any courses yet.</div>
            @else
                <ul class="space-y-3">
                    @foreach($courses as $course)
                        <li class="p-4 bg-white/70 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 rounded-lg flex items-center justify-between">
                            <div>
                                <div class="font-medium">{{ $course->title }}</div>
                                <div class="text-sm text-gray-500">@if(isset($course->pivot) && isset($course->pivot->progress)) Progress: {{ $course->pivot->progress }}% @endif</div>
                            </div>
                            <div>
                                <a href="{{ route('courses.show', $course) }}" class="text-cyan-600">Open</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div id="tab-profile" class="p-4">
            <h2 class="font-semibold mb-3">Profile</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-3 border rounded">
                    <div class="text-sm text-gray-500">Name</div>
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                </div>
                <div class="p-3 border rounded">
                    <div class="text-sm text-gray-500">Email</div>
                    <div class="font-medium">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>

        <div id="tab-assignments" class="p-4">
            <h2 class="font-semibold mb-3">Pending Assignments</h2>
            @if(empty($pendingAssignments) || $pendingAssignments->isEmpty())
                <div class="text-gray-500">No pending assignments.</div>
            @else
                <ul class="space-y-3">
                    @foreach($pendingAssignments as $a)
                        <li class="p-4 bg-white/70 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                            <div class="font-medium">{{ $a->title }}</div>
                            <div class="text-sm text-gray-500">Module: {{ optional($a->module)->title ?? '—' }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
