<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Categories</h2>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search categories..." class="px-3 py-2 rounded border">
            <button wire:click.prevent="toggleCreate" class="px-3 py-2 bg-emerald-600 text-white rounded">Add Category</button>
        </div>
    </div>

        @if($successMessage)
            <div class="mb-4">
                <p class="text-sm text-green-600">{{ $successMessage }}</p>
            </div>
        @endif

    @if($showCreate)
        <div class="mb-4">
            <div class="min-h-[72px] flex flex-col justify-center">
                    <div class="flex gap-2">
                    <input type="text" wire:model.defer="newName" placeholder="Category name" class="px-3 py-2 rounded border w-full">
                    <x-admin.action-button wire:click.prevent="create" variant="primary">Save</x-admin.action-button>
                    <x-admin.action-button wire:click.prevent="toggleCreate">Cancel</x-admin.action-button>
                </div>
                <div class="mt-2">
                    @error('newName') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <x-admin-table>
            <x-slot name="header">
                <tr>
                    <th class="p-3 font-semibold">Name</th>
                    <th class="p-3 font-semibold">Created</th>
                    <th class="p-3 font-semibold">Actions</th>
                </tr>
            </x-slot>

            @forelse($categories as $category)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="p-3">
                        @if($editingId === $category->id)
                            <div class="flex items-center gap-2">
                                <input type="text" wire:model.defer="editingName" class="px-2 py-1 border rounded w-full">
                                <x-admin.action-button wire:click.prevent="update" variant="primary">Save</x-admin.action-button>
                                <x-admin.action-button wire:click.prevent="cancelEdit">Cancel</x-admin.action-button>
                            </div>
                            @error('editingName') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        @else
                            {{ $category->name }}
                        @endif
                    </td>
                    <td class="p-3">{{ $category->created_at->format('Y-m-d') }}</td>
                    <td class="p-3">
                        @if($editingId !== $category->id)
                            <x-admin.action-button wire:click.prevent="edit({{ $category->id }})" variant="info" class="mr-2">Edit</x-admin.action-button>
                            <x-admin.action-button variant="danger" onclick="return confirm('Delete this category?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $category->id }})">Delete</x-admin.action-button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-sm text-gray-500">No categories found.</td>
                </tr>
            @endforelse

        </x-admin-table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
