<div class="p-6 space-y-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">{{ __('Create New Course') }}</h1>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Title') }}</label>
            <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
            @error('title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Description') }}</label>
            <textarea id="description" wire:model.defer="description" rows="4" class="mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100"></textarea>
            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div class="cursor-pointer">
            <label for="category_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Category') }}</label>
            <select id="category_id" wire:model.defer="category_id" class="cursor-pointer mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
                <option value="" class="cursor-pointer">{{ __('Select Category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="cursor-pointer">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Price & Discount -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Price ($)') }}</label>
                <input type="number" id="price" wire:model.defer="price" class="mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
                @error('price') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="discount" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Discount (%)') }}</label>
                <input type="number" id="discount" wire:model.defer="discount" class="mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
                @error('discount') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="cursor-pointer">
            <label for="status" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">{{ __('Status') }}</label>
            <select id="status" wire:model.defer="status" class="cursor-pointer mt-1 block w-full border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
                <option value="draft" class="cursor-pointer">{{ __('Draft') }}</option>
                <option value="pending" disabled class="cursor-not-allowed">{{ __('Pending') }}</option>
                <option value="published" disabled class="cursor-not-allowed">{{ __('Published') }}</option>
            </select>
            @error('status') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="cursor-pointer inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-white hover:bg-cyan-700 transition">
                <x-icon name="check-circle" class="w-4 h-4 mr-2" />
                {{ __('Create Course') }}
            </button>
        </div>
    </form>
</div>
