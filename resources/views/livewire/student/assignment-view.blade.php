<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('student.courses.view', $course->slug) }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">
            ← Back to {{ $course->title }}
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Assignment Details Card -->
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-8">
                <div class="mb-4">
                    <span class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                        Module {{ $module->position }}: {{ $module->title }}
                    </span>
                </div>
                
                <div class="flex items-start justify-between mb-4">
                    <h1 class="text-3xl font-bold text-cyan-700 dark:text-emerald-300">
                        {{ $assignment->title }}
                    </h1>
                    @if($submission && $submission->isGraded())
                        <div class="bg-emerald-100 dark:bg-emerald-900 px-4 py-2 rounded-lg">
                            <p class="text-sm text-emerald-700 dark:text-emerald-300 font-medium">
                                Graded: {{ $submission->grade }}/100
                            </p>
                        </div>
                    @elseif($submission)
                        <div class="bg-blue-100 dark:bg-blue-900 px-4 py-2 rounded-lg">
                            <p class="text-sm text-blue-700 dark:text-blue-300 font-medium">
                                Submitted
                            </p>
                        </div>
                    @endif
                </div>

                @if($assignment->description)
                    <div class="prose prose-emerald dark:prose-invert max-w-none mb-6">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $assignment->description }}
                        </p>
                    </div>
                @endif

                <!-- Assignment File Section -->
                @if($assignment->file_path)
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 p-4 rounded mb-6">
                        <h3 class="font-semibold text-emerald-900 dark:text-emerald-200 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Assignment File
                        </h3>
                        <a href="{{ asset('storage/'.$assignment->file_path) }}" 
                           download
                           class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition-colors font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Assignment
                        </a>
                    </div>
                @endif
            </div>

            <!-- Submission Section -->
            <div class="bg-white/80 dark:bg-zinc-900/80 rounded-2xl shadow-xl border border-emerald-100 dark:border-zinc-700 p-8">
                <h2 class="text-xl font-bold text-cyan-700 dark:text-emerald-300 mb-6">Submit Your Solution</h2>

                @if (session()->has('message'))
                    <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-700 rounded px-4 py-3">
                        {{ session('message') }}
                    </div>
                @endif

                @if($submission && !$showSubmissionForm)
                    <!-- Submission Status -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium text-blue-900 dark:text-blue-200">You have submitted your solution</span>
                            </div>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mb-2">
                                <strong>Submitted on:</strong> {{ $submission->created_at->format('F j, Y \a\t g:i A') }}
                            </p>
                            @if($submission->isGraded())
                                <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                                    <p class="text-sm text-blue-700 dark:text-blue-300 mb-3">
                                        <strong>Grade:</strong> <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $submission->grade }}/100</span>
                                    </p>
                                    @if($submission->feedback)
                                        <div>
                                            <p class="text-sm font-medium text-blue-900 dark:text-blue-200 mb-2">Instructor's Feedback:</p>
                                            <p class="text-sm text-blue-700 dark:text-blue-300 bg-white/50 dark:bg-zinc-800/50 p-3 rounded">
                                                {{ $submission->feedback }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    Waiting for instructor to grade...
                                </p>
                            @endif
                        </div>

                        <!-- View/Resubmit Options -->
                        <div class="space-y-2">
                            @if($submission->file_path)
                                <a href="{{ asset('storage/'.$submission->file_path) }}" 
                                   download
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition-colors font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download Your Submission
                                </a>
                            @endif

                            <button wire:click="resubmit" type="button"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition-colors font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16a2 2 0 012-2h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6z"></path>
                                </svg>
                                Resubmit Assignment
                            </button>
                        </div>
                    </div>
                @endif

                @if($showSubmissionForm)
                    <!-- Submission Form -->
                    <form wire:submit.prevent="submitAssignment" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload File
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       wire:model="submissionFile"
                                       class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 dark:file:bg-emerald-900 file:text-emerald-700 dark:file:text-emerald-300 hover:file:bg-emerald-100 dark:hover:file:bg-emerald-800">
                            </div>
                            @error('submissionFile')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Max file size: 10MB</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Or Write Your Solution
                            </label>
                            <textarea
                                wire:model.defer="submissionText"
                                rows="6"
                                placeholder="Write your solution or explanation here..."
                                class="w-full rounded-lg border border-emerald-200 dark:border-zinc-700 bg-white/80 dark:bg-zinc-900/80 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-emerald-500 focus:border-emerald-500">
                            </textarea>
                            @error('submissionText')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @error('submission')
                            <p class="text-sm text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-700 rounded px-4 py-2">
                                {{ $message }}
                            </p>
                        @enderror

                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-emerald-600 hover:to-cyan-600 text-white rounded-lg shadow-lg transition-all font-medium">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Submit Assignment
                            </span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
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
                                        @foreach($mod->lessons as $lesson)
                                            <li>
                                                <a href="{{ route('student.lessons.view', ['course' => $course->slug, 'lesson' => $lesson->id]) }}"
                                                   class="block text-xs py-1 px-2 rounded text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">
                                                    {{ $lesson->title }}
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
                                                   class="block text-xs py-1 px-2 rounded {{ $assign->id === $assignment->id ? 'bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800' }} transition-colors">
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
