<div class="max-w-5xl mx-auto p-6">
    <div
        x-data="{ show: false, message: '' }"
        x-show="show"
        x-text="message"
        x-transition
        x-init="
            $wire.on('toast', (data) => {
                message = data.message
                show = true
                setTimeout(() => show = false, 3000)
            })
        "
        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg"
    ></div>
    <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6 space-y-6">
        <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
            {{ __('Edit Course') }}
        </h1>

        <form wire:submit.prevent="update" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Course Title') }}
                    </label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="title"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Category') }}
                    </label>
                    <select
                        id="category_id"
                        wire:model.defer="category_id"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('Description') }}
                </label>
                <textarea
                    id="description"
                    wire:model.defer="description"
                    rows="4"
                    class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                ></textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>


            <!-- Price & Discount -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Price ($)') }}
                    </label>
                    <input
                        type="number"
                        id="price"
                        wire:model.defer="price"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                    @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="discount" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Discount (%)') }}
                    </label>
                    <input
                        type="number"
                        id="discount"
                        wire:model.defer="discount"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                    @error('discount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Banner & Video Description -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="banner" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Banner') }}
                    </label>
                    <input
                        type="file"
                        accept="image/*"
                        id="banner"
                        wire:model="banner"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                    @error('banner') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <!-- Banner preview -->
                    @if ($banner)
                        <div class="mt-2">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Preview:') }}</p>
                            <img src="{{ $banner->temporaryUrl() }}" alt="{{ __('Banner Preview') }}" class="mt-1 h-32 w-32 rounded-lg border border-zinc-300 dark:border-zinc-600">
                        </div>
                    @elseif ($existingBanner)
                        <!-- Existing file preview -->
                        <div class="mt-2">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Current Banner:') }}</p>
                            <img src="{{ asset('storage/' . $existingBanner) }}" alt="{{ __('Banner Preview') }}" class="mt-1 h-32 w-32 rounded-lg border border-zinc-300 dark:border-zinc-600">
                        </div>
                    @endif
                </div>

                <div>
                    <label for="video" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Video') }}
                    </label>
                    <input
                        type="file"
                        accept="video/*"
                        id="video"
                        wire:model="video"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    >
                    @error('video') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    <!-- Video Preview -->
                    @if ($video)
                        <div class="mt-2">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Preview:') }}</p>
                            <video src="{{ $video->temporaryUrl() }}" alt="{{ __('Video Preview') }}" class="mt-1 h-32 w-32 rounded-lg border border-zinc-300 dark:border-zinc-600" controls></video>
                        </div>
                    @elseif ($existingVideo)
                        <!-- Existing file preview -->
                        <div class="mt-2">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Current Video:') }}</p>
                            <video src="{{ asset('storage/' . $existingVideo) }}" class="mt-1 h-32 w-32 rounded-lg border border-zinc-300 dark:border-zinc-600" controls></video>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-3">
                <!-- Cancel / Back -->
                <a href="{{ route('instructor.courses.index') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                    <x-icon name="arrow-left" class="w-5 h-5 mr-2" />
                    {{ __('Cancel') }}
                </a>

                {{-- Submit button --}}
                <button
                    type="submit"
                    class="inline-flex items-center px-5 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition disabled:opacity-50"
                >
                    <x-icon name="check-circle" class="w-5 h-5 mr-2" />
                    {{ __('Update Course') }}
                </button>
            </div>
        </form>
    </div>
</div>
