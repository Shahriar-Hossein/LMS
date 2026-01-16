<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Instructors</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search instructors..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <x-admin-table>
            <x-slot name="header">
                <tr>
                    <th class="p-3 font-semibold">Name</th>
                    <th class="p-3 font-semibold">Email</th>
                    <th class="p-3 font-semibold">Joined</th>
                </tr>
            </x-slot>

            @forelse($instructors as $user)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-sm text-gray-500">No instructors found.</td>
                </tr>
            @endforelse

        </x-admin-table>
    </div>

    <div class="mt-4">
        {{ $instructors->links() }}
    </div>
</div>
