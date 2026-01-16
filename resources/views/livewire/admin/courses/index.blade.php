<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Courses</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search courses..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <x-admin-table>
            <x-slot name="header">
                <tr>
                    <th class="p-3 font-semibold">Title</th>
                    <th class="p-3 font-semibold">Category</th>
                    <th class="p-3 font-semibold">Instructor</th>
                    <th class="p-3 font-semibold">Created</th>
                </tr>
            </x-slot>

            @forelse($courses as $course)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="p-3">{{ $course->title }}</td>
                    <td class="p-3">{{ $course->category?->name ?? '-' }}</td>
                    <td class="p-3">{{ $course->instructor?->name ?? '-' }}</td>
                    <td class="p-3">{{ $course->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-sm text-gray-500">No courses found.</td>
                </tr>
            @endforelse

        </x-admin-table>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
