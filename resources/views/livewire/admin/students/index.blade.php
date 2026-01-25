<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Students</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search students..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <x-admin-table>
            <x-slot name="header">
                <tr>
                    <th class="p-3 font-semibold">Name</th>
                    <th class="p-3 font-semibold">Email</th>
                    <th class="p-3 font-semibold">Joined</th>
                    <th class="p-3 font-semibold">Action</th>
                </tr>
            </x-slot>

            @forelse($students as $student)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="p-3 font-medium">{{ $student->name }}</td>
                    <td class="p-3">{{ $student->email }}</td>
                    <td class="p-3">{{ $student->created_at->format('Y-m-d') }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.students.profile', $student) }}" class="inline-flex items-center px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            View Profile
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-sm text-gray-500">No students found.</td>
                </tr>
            @endforelse

        </x-admin-table>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>
