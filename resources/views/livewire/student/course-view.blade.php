<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('student.courses.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">
            ← Back to My Courses
        </a>
        <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 overflow-hidden">
            @if($course->banner_path)
                <img src="{{ asset('storage/'.$course->banner_path) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
            @endif
            <div class="p-6">
                <h1 class="text-3xl font-bold text-cyan-700 dark:text-emerald-300 mb-2">{{ $course->title }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $course->description }}</p>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                    <span>Instructor: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $course->instructor->name ?? 'N/A' }}</span></span>
                    <span>Category: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $course->category->name ?? 'N/A' }}</span></span>

                    <!-- Rating summary -->
                    <div class="flex items-center gap-1 ml-auto">
                        @php
                            $avg = $course->averageRating();
                            $count = $course->reviewsCount();
                        @endphp
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($avg) ? 'fill-amber-400' : 'fill-gray-300 dark:fill-zinc-700' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09L5.4 11.545 1 7.91l6.06-.545L10 2.5l2.94 4.865L19 7.91l-4.4 3.636 1.278 6.545z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">
                            @if($count > 0)
                                {{ number_format($avg, 1) }} ({{ $count }} reviews)
                            @else
                                No reviews yet
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review form for enrolled student -->
    <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6 mb-6">
        <h2 class="text-xl font-bold text-cyan-700 dark:text-emerald-300 mb-4">Your Review</h2>

        @if (session()->has('message'))
            <div class="mb-3 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded px-3 py-2">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submitReview" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rating</label>
                <div class="flex items-center gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="setRating({{ $i }})" class="focus:outline-none">
                            <svg class="w-7 h-7 {{ $rating >= $i ? 'fill-amber-400' : 'fill-gray-200 dark:fill-zinc-700' }} hover:fill-amber-300 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09L5.4 11.545 1 7.91l6.06-.545L10 2.5l2.94 4.865L19 7.91l-4.4 3.636 1.278 6.545z" />
                            </svg>
                        </button>
                    @endfor
                </div>
                @error('rating')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Comment</label>
                <textarea
                    wire:model.defer="comment"
                    rows="3"
                    class="w-full rounded-md border border-emerald-200 dark:border-zinc-700 bg-white/80 dark:bg-zinc-900/80 text-sm text-gray-900 dark:text-gray-100 focus:ring-emerald-500 focus:border-emerald-500">
                </textarea>
                @error('comment')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                Save Review
            </button>
        </form>

        @if($userReview)
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">You can update your review at any time.</p>
        @endif
    </div>

    <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6">
        <h2 class="text-2xl font-bold text-cyan-700 dark:text-emerald-300 mb-6">Course Modules</h2>

        @if($modules->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No modules available yet.</p>
        @else
            <div class="space-y-4">
                @foreach($modules as $index => $module)
                    <div class="border border-emerald-200 dark:border-zinc-700 rounded-lg overflow-hidden">
                        <button 
                            wire:click="toggleModule({{ $module->id }})"
                            class="w-full p-4 bg-gradient-to-r from-emerald-50 to-cyan-50 dark:from-zinc-800 dark:to-zinc-800 hover:from-emerald-100 hover:to-cyan-100 dark:hover:from-zinc-700 dark:hover:to-zinc-700 flex items-center justify-between transition-colors"
                        >
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-600 dark:bg-emerald-500 text-white flex items-center justify-center font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <div class="text-left">
                                    <h3 class="font-semibold text-lg text-emerald-700 dark:text-emerald-300">{{ $module->title }}</h3>
                                    @if($module->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $module->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 transition-transform {{ in_array($module->id, $expandedModules) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        @if(in_array($module->id, $expandedModules))
                            <div class="p-4 bg-white dark:bg-zinc-900 border-t border-emerald-100 dark:border-zinc-700">
                                <!-- Lessons -->
                                @if($module->lessons->isNotEmpty())
                                    <h4 class="font-semibold text-emerald-700 dark:text-emerald-300 mb-3">📚 Lessons</h4>
                                    <ul class="space-y-2 mb-4">
                                        @foreach($module->lessons as $lesson)
                                            <li>
                                                <a href="{{ route('student.lessons.view', ['course' => $course->slug, 'lesson' => $lesson->id]) }}" 
                                                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-emerald-50 dark:hover:bg-zinc-800 transition-colors group">
                                                    <div class="w-8 h-8 rounded-full bg-cyan-100 dark:bg-cyan-900 text-cyan-700 dark:text-cyan-300 flex items-center justify-center text-sm font-medium">
                                                        {{ $lesson->position }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-800 dark:text-gray-200 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                                            {{ $lesson->title }}
                                                        </div>
                                                        @if($lesson->description)
                                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                {{ Str::limit($lesson->description, 60) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <!-- Assignments -->
                                @if($module->assignments->isNotEmpty())
                                    <h4 class="font-semibold text-emerald-700 dark:text-emerald-300 mb-3">📝 Assignments</h4>
                                    <ul class="space-y-2">
                                        @foreach($module->assignments as $assignment)
                                            <li>
                                                <a href="{{ route('student.assignments.view', ['course' => $course->slug, 'assignment' => $assignment->id]) }}" 
                                                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition-colors group bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
                                                    <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 flex items-center justify-center text-sm font-medium">
                                                        {{ $assignment->position }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-800 dark:text-gray-200 group-hover:text-yellow-700 dark:group-hover:text-yellow-300">
                                                            {{ $assignment->title }}
                                                        </div>
                                                        @if($assignment->description)
                                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                                {{ Str::limit($assignment->description, 60) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if($module->lessons->isEmpty() && $module->assignments->isEmpty())
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">No content available in this module yet.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if(!empty($reviews) && count($reviews) > 0)
        <div class="mt-6 bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-bold text-cyan-700 dark:text-emerald-300 mb-4">Student Reviews</h2>

            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="border border-emerald-100 dark:border-zinc-700 rounded-lg p-4 bg-white/80 dark:bg-zinc-900/80">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ $review->user->name ?? 'Student' }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $review->rating >= $i ? 'fill-amber-400' : 'fill-gray-200 dark:fill-zinc-700' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09L5.4 11.545 1 7.91l6.06-.545L10 2.5l2.94 4.865L19 7.91l-4.4 3.636 1.278 6.545z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
