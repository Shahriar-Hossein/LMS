<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Instructors</h2>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search instructors..." class="px-3 py-2 rounded border">
    </div>

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <table class="w-full text-sm">
            <thead class="text-left text-xs text-gray-600 dark:text-gray-300 uppercase">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Joined</th>
                </tr>
            </thead>
            <tbody>
            @forelse($instructors as $user)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ $user->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-sm text-gray-500">No instructors found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $instructors->links() }}
    </div>
</div>
