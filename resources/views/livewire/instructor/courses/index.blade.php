<div class="p-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">My Courses</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 px-4 py-2 rounded mb-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('instructor.courses.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
            + Create New Course
        </a>
    </div>

    @if ($courses->count())
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full text-sm text-left border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="p-3 font-semibold">Title</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold">Created At</th>
                        <th class="p-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                    @foreach ($courses as $course)
                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="p-3">{{ $course->title }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $course->status === 'published'
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                                        : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $course->created_at->format('M d, Y') }}</td>
                            <td class="p-3 text-right space-x-2">
                                <a href="{{ route('instructor.courses.edit', $course) }}"
                                   class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                                <button wire:click="delete({{ $course->id }})"
                                   class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-300">No courses found. Start by creating one!</p>
    @endif
</div>
