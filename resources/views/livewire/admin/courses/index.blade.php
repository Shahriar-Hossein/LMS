<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Courses</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search courses..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <table class="w-full text-sm">
            <thead class="text-left text-xs text-gray-600 dark:text-gray-300 uppercase">
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Instructor</th>
                    <th class="px-4 py-2">Created</th>
                </tr>
            </thead>
            <tbody>
            @forelse($courses as $course)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $course->title }}</td>
                    <td class="px-4 py-3">{{ $course->category?->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $course->instructor?->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $course->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-sm text-gray-500">No courses found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
