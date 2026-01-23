<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('student.courses.view', $course->slug) }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">
            ← Back to {{ $course->title }}
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Video Player -->
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 overflow-hidden">
                @if($lesson->video_path)
                    <div class="relative bg-black aspect-video">
                        <video 
                            controls 
                            class="w-full h-full"
                            controlsList="nodownload"
                        >
                            <source src="{{ asset('storage/'.$lesson->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @else
                    <div class="aspect-video bg-gradient-to-br from-emerald-100 to-cyan-100 dark:from-emerald-900 dark:to-cyan-900 flex items-center justify-center">
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <p>No video available for this lesson</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Lesson Details -->
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6">
                <div class="mb-4">
                    <span class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                        Module {{ $module->position }}: {{ $module->title }}
                    </span>
                </div>
                <h1 class="text-3xl font-bold text-cyan-700 dark:text-emerald-300 mb-4">
                    {{ $lesson->title }}
                </h1>
                @if($lesson->description)
                    <div class="prose prose-emerald dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $lesson->description }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Navigation -->
            <div class="flex items-center justify-between gap-4">
                @if($prevLesson)
                    <a href="{{ route('student.lessons.view', ['course' => $course->slug, 'lesson' => $prevLesson->id]) }}" 
                       class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-emerald-600 hover:to-cyan-600 text-white rounded-lg shadow-lg transition-all font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous Lesson
                    </a>
                @else
                    <div></div>
                @endif

                @if($nextLesson)
                    <a href="{{ route('student.lessons.view', ['course' => $course->slug, 'lesson' => $nextLesson->id]) }}" 
                       class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-emerald-600 hover:to-cyan-600 text-white rounded-lg shadow-lg transition-all font-medium">
                        Next Lesson
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>

        <!-- Sidebar - Course Outline -->
        <div class="lg:col-span-1">
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6 sticky top-6">
                <h2 class="text-lg font-bold text-cyan-700 dark:text-emerald-300 mb-4">Module Outline</h2>
                <div class="space-y-3 max-h-[600px] overflow-y-auto">
                    @foreach($course->modules as $mod)
                        <div class="border-l-4 {{ $mod->id === $module->id ? 'border-emerald-500' : 'border-gray-300 dark:border-gray-600' }} pl-3">
                            <div class="font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                {{ $mod->position }}. {{ $mod->title }}
                            </div>

                            @if($mod->lessons->isNotEmpty())
                                <div class="mb-3">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Lessons</p>
                                    <ul class="space-y-1">
                                        @foreach($mod->lessons as $l)
                                            <li>
                                                <a href="{{ route('student.lessons.view', ['course' => $course->slug, 'lesson' => $l->id]) }}" 
                                                   class="block text-xs py-1 px-2 rounded {{ $l->id === $lesson->id ? 'bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800' }} transition-colors">
                                                    {{ $l->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($mod->assignments->isNotEmpty())
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Assignments</p>
                                    <ul class="space-y-1">
                                        @foreach($mod->assignments as $assign)
                                            <li>
                                                <a href="{{ route('student.assignments.view', ['course' => $course->slug, 'assignment' => $assign->id]) }}"
                                                   class="block text-xs py-1 px-2 rounded {{ (isset($assignment) && $assign->id === $assignment->id) ? 'bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800' }} transition-colors">
                                                    {{ $assign->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
