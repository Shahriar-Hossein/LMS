<div class="p-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Students</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 px-4 py-2 rounded mb-3">
            {{ session('message') }}
        </div>
    @endif

    @if ($students->count())
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full text-sm text-left border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="p-3 font-semibold">SL</th>
                        <th class="p-3 font-semibold">Name</th>
                        <th class="p-3 font-semibold">Email</th>
                        <th class="p-3 font-semibold text-center">Enrolled</th>
                        <th class="p-3 font-semibold text-center">DOB</th>
                        <th class="p-3 font-semibold text-center">Gender</th>
                        <th class="p-3 font-semibold text-center">Phone</th>
                        <th class="p-3 font-semibold">Address</th>
                        <th class="p-3 font-semibold">Occupation</th>
                        <th class="p-3 font-semibold">Organization</th>
                        <th class="p-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                    @foreach ($students as $index => $student)
                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="p-3">{{ $index + 1 }}</td>

                            <!-- Name + Avatar -->
                            <td class="p-3 flex items-center space-x-2">
                                <img
                                    src="{{ $student->image_path ? asset('storage/' . $student->image_path) : 'https://ui-avatars.com/api/?name=' . $student->name }}"
                                    alt="{{ $student->name }}"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                                >
                                <span class="font-medium">{{ $student->name }}</span>
                            </td>

                            <td class="p-3">{{ $student->email }}</td>

                            <!-- Random placeholder until real count added -->
                            <td class="p-3 text-center font-semibold text-gray-700 dark:text-gray-200">
                                {{ rand(1, 10) }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $student?->date_of_birth ? Date::parse($student->date_of_birth)->format('d F, Y') : 'N/A' }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $student->gender ?? 'N/A' }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $student->phone_no ?? 'N/A' }}
                            </td>

                            <td class="p-3 truncate max-w-[140px]">
                                {{ $student->address ?? 'N/A' }}
                            </td>

                            <td class="p-3 truncate max-w-[120px]">
                                {{ $student->occupation ?? 'N/A' }}
                            </td>

                            <td class="p-3 truncate max-w-[120px]">
                                {{ $student->organization ?? 'N/A' }}
                            </td>

                            <td class="p-3 text-right space-x-2">
                                <a href="#"
                                   class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 shadow-sm">
                                    View
                                </a>

                                <button wire:click="ban({{ $student->id }})"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 shadow-sm cursor-pointer">
                                    Ban
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-300">No students found.</p>
    @endif
</div>
