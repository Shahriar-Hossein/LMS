<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6 space-y-6">
        <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
            {{ __('Profile Settings') }}
        </h1>

        <form wire:submit.prevent="updateProfile" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Name') }}
                    </label>
                    <input type="text" wire:model="name" id="name" required
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Email') }}
                    </label>
                    <input type="email" wire:model="email" id="email" required
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Phone No --}}
                <div>
                    <label for="phone_no" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Phone No') }}
                    </label>
                    <input type="text" wire:model="phone_no" id="phone_no"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('phone_no') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Address') }}
                    </label>
                    <input type="text" wire:model="address" id="address"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Gender --}}
                <div>
                    <label for="gender" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Gender') }}
                    </label>
                    <select wire:model="gender" id="gender"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('gender') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Date of Birth --}}
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Date of Birth') }}
                    </label>
                    <input type="date" wire:model="date_of_birth" id="date_of_birth"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('date_of_birth') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Occupation --}}
                <div>
                    <label for="occupation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Occupation') }}
                    </label>
                    <input type="text" wire:model="occupation" id="occupation"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('occupation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Organization --}}
                <div>
                    <label for="organization" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Organization') }}
                    </label>
                    <input type="text" wire:model="organization" id="organization"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('organization') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Image --}}
                <div class="sm:col-span-2">
                    <label for="image_path" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ __('Profile Image') }}
                    </label>
                    <input type="file" wire:model="image_path" id="image_path"
                        class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('image_path') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    
                    @if ($image_path && !is_string($image_path))
                        <div class="mt-2">
                             <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-1">{{ __('Preview:') }}</p>
                            <img src="{{ $image_path->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border border-zinc-200 dark:border-zinc-700">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition">
                    {{ __('Update Profile') }}
                </button>
            </div>
        </form>
    </div>
</div>
