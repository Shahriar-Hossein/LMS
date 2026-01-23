<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300">All Courses</h2>
        <a href="{{ route('courses.index') }}" class="text-sm text-emerald-600 hover:underline">My enrolled courses</a>
    </div>

    @if($courses->isEmpty())
        <div class="text-sm text-zinc-500">No courses available.</div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($courses as $course)
                <div class="bg-white/60 dark:bg-zinc-800/60 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Course Banner -->
                    <div class="relative">
                        <img src="{{ $course->banner_path ? asset('storage/'.$course->banner_path) : asset('images/placeholder.png') }}"
                             alt="{{ $course->title }}" 
                             class="w-full h-48 object-cover">
                        @if($course->discount > 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Save ৳{{ number_format($course->discount) }}
                            </div>
                        @endif
                    </div>

                    <!-- Course Details -->
                    <div class="p-4">
                        <a href="{{ route('student.courses.detail', $course) }}">
                            <h3 class="font-semibold text-lg text-emerald-700 dark:text-emerald-300 mb-2 hover:text-emerald-800 dark:hover:text-emerald-200">
                                {{ $course->title }}
                            </h3>
                        </a>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4 line-clamp-2">
                            {{ $course->description }}
                        </p>

                        <!-- Price and Action -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                @php
                                    $finalPrice = $course->price - ($course->discount ?? 0);
                                @endphp
                                @if($finalPrice > 0)
                                    <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                                        ৳{{ number_format($finalPrice) }}
                                    </span>
                                    @if($course->discount > 0)
                                        <span class="text-sm text-gray-500 line-through">
                                            ৳{{ number_format($course->price) }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                                        Free
                                    </span>
                                @endif
                            </div>

                            @if(in_array($course->id, $enrolled))
                                <a href="{{ route('student.courses.view', $course) }}" 
                                   class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                    Enrolled
                                </a>
                            @else
                                <form action="{{ route('payment.initiate', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                                        Enroll Now
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Course Info -->
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-zinc-700 flex items-center gap-4 text-xs text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                {{ $course->modules()->count() }} Modules
                            </span>
                            @if($course->instructor)
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $course->instructor->name }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
