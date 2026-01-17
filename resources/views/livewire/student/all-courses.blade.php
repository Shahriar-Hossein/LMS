<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300">All Courses</h2>
        <a href="{{ route('student.courses.index') }}" class="text-sm text-emerald-600 hover:underline">My enrolled courses</a>
    </div>

    @if($courses->isEmpty())
        <div class="text-sm text-zinc-500">No courses available.</div>
    @else
        <ul class="space-y-4">
            @foreach($courses as $course)
                <li class="flex items-start gap-4 bg-white/60 dark:bg-zinc-800/60 p-4 rounded-md shadow-sm">
                    <img src="{{ $course->banner_path ? asset('storage/'.$course->banner_path) : asset('images/placeholder.png') }}"
                         alt="{{ $course->title }}" class="w-20 h-16 object-cover rounded">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('courses.show', $course) }}" class="font-medium text-emerald-700 dark:text-emerald-300">{{ $course->title }}</a>
                            @if(in_array($course->id, $enrolled))
                                <span class="text-sm text-zinc-500">Enrolled</span>
                            @else
                                <button wire:click="enroll({{ $course->id }})"
                                        class="text-sm text-white bg-emerald-600 hover:bg-emerald-700 px-3 py-1 rounded">Enroll</button>
                            @endif
                        </div>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ \Illuminate\Support\Str::limit($course->description, 50) }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
