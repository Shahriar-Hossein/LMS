<div class="mt-6">
    <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6">
        <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100">Modules</h2>

        <div class="mt-4 grid grid-cols-1 gap-4">
            <div class="flex gap-3">
                <input type="text" wire:model.defer="newModuleTitle" placeholder="New module title"
                    class="w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500" />
                <button wire:click.prevent="createModule"
                    class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white">Create</button>
            </div>

            <div class="space-y-3">
                @foreach($modules as $mod)
                    <div class="p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 flex items-center justify-between">
                        <div>
                            <div class="font-medium text-zinc-800 dark:text-zinc-100">{{ $mod->title }}</div>
                            <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ $mod->description }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click.prevent="selectModule({{ $mod->id }})" class="px-3 py-1 rounded bg-cyan-600 hover:bg-cyan-700 text-white">Manage</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($selectedModule)
            <div class="mt-6 border-t pt-4">
                <h3 class="font-semibold text-zinc-800 dark:text-zinc-100">Manage: {{ $selectedModule->title }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-4">
                        <h4 class="font-medium">Add Lesson</h4>
                        <input type="text" wire:model.defer="lessonTitle" placeholder="Lesson title"
                            class="mt-2 w-full rounded-lg border border-zinc-300 dark:border-zinc-600 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100" />
                        <textarea wire:model.defer="lessonDescription" placeholder="Lesson description" class="mt-2 w-full rounded-lg border border-zinc-300 dark:border-zinc-600 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100"></textarea>
                        <input type="file" wire:model="lessonVideo" accept="video/*" class="mt-2 w-full" />
                        <div class="flex justify-end mt-3">
                            <button wire:click.prevent="createLesson" class="px-4 py-2 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white">Add Lesson</button>
                        </div>

                        <div class="mt-4">
                            <h5 class="font-medium">Lessons</h5>
                            <ul class="mt-2 space-y-2">
                                @foreach($selectedModule->lessons as $lesson)
                                    <li class="text-sm text-zinc-700 dark:text-zinc-300">{{ $lesson->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-4">
                        <h4 class="font-medium">Add Assignment</h4>
                        <input type="text" wire:model.defer="assignmentTitle" placeholder="Assignment title"
                            class="mt-2 w-full rounded-lg border border-zinc-300 dark:border-zinc-600 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100" />
                        <textarea wire:model.defer="assignmentDescription" placeholder="Assignment description" class="mt-2 w-full rounded-lg border border-zinc-300 dark:border-zinc-600 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100"></textarea>
                        <input type="file" wire:model="assignmentFile" accept="application/pdf,image/*" class="mt-2 w-full" />
                        <div class="flex justify-end mt-3">
                            <button wire:click.prevent="createAssignment" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white">Add Assignment</button>
                        </div>

                        <div class="mt-4">
                            <h5 class="font-medium">Assignments</h5>
                            <ul class="mt-2 space-y-2">
                                @foreach($selectedModule->assignments as $a)
                                    <li class="flex items-center justify-between text-sm text-zinc-700 dark:text-zinc-300 p-2 bg-white dark:bg-zinc-900 rounded border border-zinc-200 dark:border-zinc-700">
                                        <span>{{ $a->title }}</span>
                                        <a href="{{ route('instructor.assignments.grade', ['course' => $course->slug, 'assignment' => $a->id]) }}" 
                                           class="px-2 py-1 text-xs bg-cyan-500 hover:bg-cyan-600 text-white rounded transition-colors">
                                            Grade
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
