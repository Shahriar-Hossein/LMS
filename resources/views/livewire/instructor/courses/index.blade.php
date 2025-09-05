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
                        <th class="p-3 font-semibold">SL</th>
                        <th class="p-3 font-semibold">Title</th>
                        <th class="p-3 font-semibold">Category</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold">Price(TK)</th>
                        <th class="p-3 font-semibold">Discount</th>
                        <th class="p-3 font-semibold">Enrolled Students</th>
                        <th class="p-3 font-semibold">Revenue(TK)</th>
                        <th class="p-3 font-semibold">Created At</th>
                        <th class="p-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                    @foreach ($courses as $index => $course)
                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3 inline-flex items-center space-x-1">
                                {{-- small course image --}}
                                <img
                                    src="{{ asset('storage/' . $course->banner_path) }}"
                                    alt="{{ $course->title }}"
                                    class="w-6 h-6 object-cover rounded cursor-pointer"
                                >
                                <span>{{ $course->title }}</span>
                            </td>
                            <td class="p-3">{{ $course->category->name }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $course->status === 'published'
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                                        : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td class="p-3 inline-flex self-align-end w-[100%] justify-end pr-0 sm:pr-2 md:pr-10">
                                {{ $course->price }}
                                <svg
                                    class="self-center h-3 w-3 fill-emerald-300 ml-1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"
                                >
                                        <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M36 32.3C18.4 30.1 2.4 42.5 .3 60S10.5 93.6 28 95.8l7.9 1c16 2 28 15.6 28 31.8l0 31.5-40 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l40 0 0 176c0 53 43 96 96 96l32 0c106 0 192-86 192-192l0-32c0-53-43-96-96-96l-16 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l16 0c17.7 0 32 14.3 32 32l0 32c0 70.7-57.3 128-128 128l-32 0c-17.7 0-32-14.3-32-32l0-176 40 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-40 0 0-31.5C128 80.1 92 39.2 43.9 33.2l-7.9-1z"/>
                                </svg>
                            </td>
                            <td class="p-3 text-end pr-0 sm:pr-2 md:pr-10">
                                {{ $course->discount }}%
                            </td>
                            <td class="p-3">Coming Soon</td>
                            <td
                                class="p-3 inline-flex self-align-end w-[100%] justify-end pr-0 sm:pr-2 md:pr-10"
                            >
                                0
                                <svg
                                    class="self-center h-3 w-3 fill-emerald-300 ml-1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"
                                >
                                        <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M36 32.3C18.4 30.1 2.4 42.5 .3 60S10.5 93.6 28 95.8l7.9 1c16 2 28 15.6 28 31.8l0 31.5-40 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l40 0 0 176c0 53 43 96 96 96l32 0c106 0 192-86 192-192l0-32c0-53-43-96-96-96l-16 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l16 0c17.7 0 32 14.3 32 32l0 32c0 70.7-57.3 128-128 128l-32 0c-17.7 0-32-14.3-32-32l0-176 40 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-40 0 0-31.5C128 80.1 92 39.2 43.9 33.2l-7.9-1z"/>
                                </svg>
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
