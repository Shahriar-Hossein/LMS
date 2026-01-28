<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.instructors.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">
            ← Back to Instructors
        </a>
        <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-cyan-700 dark:text-emerald-300 mb-2">{{ $instructor->name }}</h1>
                        <p class="text-gray-600 dark:text-gray-400">{{ $instructor->email }}</p>
                    </div>
                    @if($instructor->image_path)
                        <img src="{{ asset('storage/'.$instructor->image_path) }}" alt="{{ $instructor->name }}" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-300 dark:border-emerald-600">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center text-white text-2xl font-bold border-2 border-emerald-300 dark:border-emerald-600">
                            {{ $instructor->initials() }}
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($instructor->phone_no)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Phone</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->phone_no }}</p>
                        </div>
                    @endif
                    
                    @if($instructor->gender)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Gender</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($instructor->gender) }}</p>
                        </div>
                    @endif

                    @if($instructor->address)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Address</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->address }}</p>
                        </div>
                    @endif

                    @if($instructor->occupation)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Occupation</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->occupation }}</p>
                        </div>
                    @endif

                    @if($instructor->organization)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Organization</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->organization }}</p>
                        </div>
                    @endif

                    @if($instructor->date_of_birth)
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Date of Birth</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->date_of_birth->format('Y-m-d') }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Member Since</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $instructor->created_at->format('M d, Y') }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Total Courses</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $courses->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructor's Courses -->
    <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-6">
        <h2 class="text-2xl font-bold text-cyan-700 dark:text-emerald-300 mb-6">Courses Created ({{ $courses->count() }})</h2>

        @if($courses->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">This instructor has not created any courses yet.</p>
        @else
            <div class="space-y-4">
                @foreach($courses as $course)
                    <div class="border border-emerald-200 dark:border-zinc-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-emerald-700 dark:text-emerald-300">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($course->description, 100) }}</p>
                                <div class="flex flex-wrap items-center gap-4 mt-3 text-xs text-gray-500 dark:text-gray-400">
                                    <span>Category: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $course->category?->name ?? '-' }}</span></span>
                                    <span>Modules: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $course->modules_count }}</span></span>
                                    <span>Enrolled: <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $course->students_count }}</span></span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('admin.courses.view', $course->slug) }}" class="inline-flex items-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                View Course
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
