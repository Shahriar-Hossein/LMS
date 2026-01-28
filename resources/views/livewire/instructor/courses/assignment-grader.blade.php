<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('instructor.courses.edit', $course->slug) }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">
            ← Back to Course Management
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-cyan-700 dark:text-emerald-300 mb-2">{{ $assignment->title }}</h1>
                {{-- <p class="text-gray-600 dark:text-gray-400">Module: {{ $module->title }}</p> --}}
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Submissions</p>
                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ count($submissions) }}</p>
            </div>
        </div>

        @if($assignment->description)
            <div class="prose prose-emerald dark:prose-invert max-w-none">
                <p class="text-gray-700 dark:text-gray-300">{{ $assignment->description }}</p>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Submissions List -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6">
                <h2 class="text-lg font-bold text-cyan-700 dark:text-emerald-300 mb-4">Student Submissions</h2>
                
                @if($submissions->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">No submissions yet</p>
                    </div>
                @else
                    <div class="space-y-2 max-h-[600px] overflow-y-auto">
                        @foreach($submissions as $submission)
                            <button 
                                wire:click="selectSubmission({{ $submission->id }})"
                                class="w-full text-left p-4 rounded-lg border-2 transition-all {{ $selectedSubmission && $selectedSubmission->id === $submission->id ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-gray-200 dark:border-zinc-700 hover:border-gray-300 dark:hover:border-zinc-600' }}">
                                
                                <div class="flex items-start justify-between mb-2">
                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ $submission->student->name }}
                                    </span>
                                    <span class="px-2 py-1 text-xs rounded font-medium
                                        @if($submission->status === 'graded')
                                            bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300
                                        @elseif($submission->status === 'submitted')
                                            bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300
                                        @else
                                            bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300
                                        @endif">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </div>

                                <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <p>{{ $submission->student->email }}</p>
                                </div>

                                <div class="text-xs text-gray-500 dark:text-gray-500">
                                    @if($submission->isGraded())
                                        <p class="font-medium text-emerald-600 dark:text-emerald-400">Grade: {{ $submission->grade }}/100</p>
                                        <p>{{ $submission->graded_at->format('M j, Y') }}</p>
                                    @else
                                        <p>Submitted: {{ $submission->created_at->format('M j, Y g:i A') }}</p>
                                    @endif
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Submission Details and Grading -->
        <div class="lg:col-span-2">
            @if($selectedSubmission)
                <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6 space-y-6">
                    <!-- Student Info -->
                    <div class="border-b border-gray-200 dark:border-zinc-700 pb-4">
                        <h3 class="text-lg font-bold text-cyan-700 dark:text-emerald-300 mb-2">
                            {{ $selectedSubmission->student->name }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $selectedSubmission->student->email }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500">
                            Submitted: <span class="font-medium">{{ $selectedSubmission->created_at->format('F j, Y \a\t g:i A') }}</span>
                        </p>
                    </div>

                    <!-- Submission Content -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Submission Content</h4>

                        @if($selectedSubmission->file_path)
                            <div class="bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-700 rounded-lg p-4 mb-4">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium text-cyan-900 dark:text-cyan-200">Submitted File</span>
                                </div>
                                <a href="{{ asset('storage/'.$selectedSubmission->file_path) }}" 
                                   download
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition-colors text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download Submission
                                </a>
                            </div>
                        @endif

                        @if($selectedSubmission->submission_text)
                            <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 mb-4">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Student's Text Submission:</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $selectedSubmission->submission_text }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Grading Form -->
                    <div class="border-t border-gray-200 dark:border-zinc-700 pt-6">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Grade & Feedback</h4>

                        @if (session()->has('message'))
                            <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-700 rounded px-4 py-3">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="submitGrade" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Grade (Out of 100)
                                </label>
                                <input type="number" 
                                       wire:model.defer="grade"
                                       min="0" 
                                       max="100"
                                       class="w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-3 focus:ring-emerald-500 focus:border-emerald-500">
                                @error('grade')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Feedback
                                </label>
                                <textarea 
                                    wire:model.defer="feedback"
                                    rows="4"
                                    placeholder="Provide detailed feedback about the submission..."
                                    class="w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-3 focus:ring-emerald-500 focus:border-emerald-500">
                                </textarea>
                                @error('feedback')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-emerald-600 hover:to-cyan-600 text-white rounded-lg shadow-lg transition-all font-medium">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Submit Grade & Feedback
                                </span>
                            </button>
                        </form>

                        @if($selectedSubmission->isGraded())
                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-zinc-700">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <strong>Already graded by:</strong> {{ $selectedSubmission->grader->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <strong>Graded on:</strong> {{ $selectedSubmission->graded_at->format('F j, Y \a\t g:i A') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Select a submission to view and grade</p>
                </div>
            @endif
        </div>
    </div>
</div>
