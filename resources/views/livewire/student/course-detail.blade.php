<div class="max-w-6xl mx-auto">
    <!-- Course Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-cyan-600 rounded-2xl shadow-xl p-8 text-white mb-6">
        <div class="flex items-start gap-4 mb-4">
            <a href="{{ route('student.courses.all') }}" class="text-white/80 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
                <p class="text-emerald-100 mb-4">{{ $course->description }}</p>
                
                <div class="flex flex-wrap gap-4 text-sm">
                    @if($course->instructor)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ $course->instructor->name }}</span>
                        </div>
                    @endif
                    @if($course->category)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span>{{ $course->category->name }}</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>{{ $course->modules->count() }} Modules</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Course Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Course Banner/Video -->
            @if($course->banner_path || $course->video_path)
                <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 overflow-hidden">
                    @if($course->video_path)
                        <video controls class="w-full aspect-video">
                            <source src="{{ asset('storage/'.$course->video_path) }}" type="video/mp4">
                        </video>
                    @elseif($course->banner_path)
                        <img src="{{ asset('storage/'.$course->banner_path) }}" alt="{{ $course->title }}" class="w-full aspect-video object-cover">
                    @endif
                </div>
            @endif

            <!-- Course Curriculum -->
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6">
                <h2 class="text-2xl font-bold text-cyan-700 dark:text-emerald-300 mb-4">Course Curriculum</h2>
                
                @if($course->modules->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">No modules available yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($course->modules as $module)
                            <div class="border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 dark:bg-zinc-800/50 p-4 font-semibold text-gray-800 dark:text-gray-200">
                                    Module {{ $module->position }}: {{ $module->title }}
                                </div>
                                @if($module->lessons->isNotEmpty())
                                    <ul class="divide-y divide-gray-200 dark:divide-zinc-700">
                                        @foreach($module->lessons as $lesson)
                                            <li class="p-4 flex items-center gap-3 text-gray-700 dark:text-gray-300">
                                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ $lesson->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Enrollment Card -->
        <div class="lg:col-span-1">
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6 sticky top-6">
                @php
                    $price = floatval($course->price);
                    $discountPercent = floatval($course->discount ?? 0);
                    $discountAmount = ($discountPercent > 0) ? ($price * ($discountPercent / 100)) : 0;
                    $finalPrice = max(0, $price - $discountAmount);
                @endphp

                <!-- Price Display -->
                <div class="mb-6">
                    @if($finalPrice > 0)
                        <div class="flex items-baseline gap-2 mb-2">
                                <span class="text-4xl font-bold text-emerald-600 dark:text-emerald-400">
                                ৳{{ number_format($finalPrice, 2) }}
                            </span>
                            @if($course->discount > 0)
                                <span class="text-xl text-gray-500 line-through">
                                    ৳{{ number_format($course->price) }}
                                </span>
                            @endif
                        </div>
                        @if($course->discount > 0)
                            <div class="inline-block bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-400 px-3 py-1 rounded-full text-sm font-semibold">
                                Save ৳{{ number_format($discountAmount, 2) }}!
                            </div>
                        @endif
                    @else
                        <span class="text-4xl font-bold text-emerald-600 dark:text-emerald-400">
                            Free Course
                        </span>
                    @endif
                </div>

                <!-- Enrollment Button -->
                @if($isEnrolled)
                    <a href="{{ route('student.courses.view', $course) }}" 
                       class="block w-full bg-gradient-to-r from-cyan-600 to-emerald-600 hover:from-cyan-700 hover:to-emerald-700 text-white font-bold py-4 px-6 rounded-lg text-center transition-all duration-200 shadow-lg hover:shadow-xl mb-4">
                        Continue Learning
                    </a>
                @else
                    <form action="{{ route('payment.initiate', $course) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl mb-4">
                            @if($finalPrice > 0)
                                Enroll Now - Pay ৳{{ number_format($finalPrice) }}
                            @else
                                Enroll for Free
                            @endif
                        </button>
                    </form>
                @endif

                <!-- Course Features -->
                <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Lifetime access</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $course->modules->count() }} modules included</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Certificate of completion</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Instructor support</span>
                    </div>
                </div>

                <!-- Payment Methods -->
                @if($finalPrice > 0 && !$isEnrolled)
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-zinc-700">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Secure payment powered by:</p>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">SSLCommerz</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
