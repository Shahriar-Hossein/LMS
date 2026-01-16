<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Categories</h2>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search categories..." class="px-3 py-2 rounded border">
            <button wire:click.prevent="toggleCreate" class="px-3 py-2 bg-emerald-600 text-white rounded">Add Category</button>
        </div>
    </div>

    @if($showCreate)
        <div class="mb-4">
            <div class="flex gap-2">
                <input type="text" wire:model.defer="newName" placeholder="Category name" class="px-3 py-2 rounded border w-full">
                <button wire:click.prevent="create" class="px-3 py-2 bg-emerald-600 text-white rounded">Save</button>
                <button wire:click.prevent="toggleCreate" class="px-3 py-2 border rounded">Cancel</button>
            </div>
            @error('newName') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
        </div>
    @endif

    <div class="overflow-x-auto bg-white/80 dark:bg-zinc-900/80 rounded-lg shadow-sm">
        <table class="w-full text-sm">
            <thead class="text-left text-xs text-gray-600 dark:text-gray-300 uppercase">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Created</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        @if($editingId === $category->id)
                            <div class="flex items-center gap-2">
                                <input type="text" wire:model.defer="editingName" class="px-2 py-1 border rounded w-full">
                                <button wire:click.prevent="update" class="px-2 py-1 bg-emerald-600 text-white rounded">Save</button>
                                <button wire:click.prevent="cancelEdit" class="px-2 py-1 border rounded">Cancel</button>
                            </div>
                            @error('editingName') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        @else
                            {{ $category->name }}
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $category->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-3">
                        @if($editingId !== $category->id)
                            <button wire:click.prevent="edit({{ $category->id }})" class="px-2 py-1 mr-2 border rounded">Edit</button>
                            <button onclick="return confirm('Delete this category?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $category->id }})" class="px-2 py-1 border rounded text-red-600">Delete</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-sm text-gray-500">No categories found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
