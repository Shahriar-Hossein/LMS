<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300">My Courses</h2>
        <a href="{{ route('courses.index') }}" class="text-sm text-emerald-600 hover:underline">Browse all courses</a>
    </div>

    @if($courses->isEmpty())
        <div class="text-sm text-zinc-500">You are not enrolled in any courses yet.</div>
    @else
        <ul class="space-y-4">
            @foreach($courses as $course)
                <li class="flex items-start gap-4 bg-white/60 dark:bg-zinc-800/60 p-4 rounded-md shadow-sm">
                    <img src="{{ $course->banner_path ? asset('storage/'.$course->banner_path) : asset('images/placeholder.png') }}"
                         alt="{{ $course->title }}" class="w-20 h-16 object-cover rounded">
                    <div class="flex-1">
                        <a href="{{ route('student.courses.view', $course) }}" class="font-medium text-emerald-700 dark:text-emerald-300">{{ $course->title }}</a>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ \Illuminate\Support\Str::limit($course->description, 50) }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
