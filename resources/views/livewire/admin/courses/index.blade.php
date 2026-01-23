<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Courses</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search courses or instructor..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <x-admin-table>
            <x-slot name="header">
                <tr>
                    <th class="p-3 font-semibold">Title</th>
                    <th class="p-3 font-semibold">Category</th>
                    <th class="p-3 font-semibold">Instructor</th>
                    <th class="p-3 font-semibold">Students</th>
                    <th class="p-3 font-semibold">Status</th>
                    <th class="p-3 font-semibold">Created</th>
                    <th class="p-3 font-semibold">Action</th>
                </tr>
            </x-slot>

            @forelse($courses as $course)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="p-3 font-medium">{{ $course->title }}</td>
                    <td class="p-3">{{ $course->category?->name ?? '-' }}</td>
                    <td class="p-3">
                        <div>
                            <p class="font-medium text-sm">{{ $course->instructor?->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $course->instructor?->email ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                            {{ $course->students_count }}
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($course->status === 'published')
                                bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                            @elseif($course->status === 'review')
                                bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300
                            @else
                                bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300
                            @endif">
                            {{ ucfirst($course->status) }}
                        </span>
                    </td>
                    <td class="p-3 text-sm">{{ $course->created_at->format('Y-m-d') }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.courses.view', $course) }}" class="inline-flex items-center px-2 py-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-sm text-gray-500">No courses found.</td>
                </tr>
            @endforelse

        </x-admin-table>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
