<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-900 shadow rounded-2xl p-6 space-y-6">
        <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
            {{ __('Update Password') }}
        </h1>
        <p class="text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Ensure your account is using a long, random password to stay secure') }}
        </p>

        <form wire:submit.prevent="updatePassword" class="space-y-6">
            <div>
                <label for="current_password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('Current Password') }}
                </label>
                <input type="password" wire:model="current_password" id="current_password" required
                    class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    autocomplete="current-password">
                @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('New Password') }}
                </label>
                <input type="password" wire:model="password" id="password" required
                    class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    autocomplete="new-password">
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    {{ __('Confirm Password') }}
                </label>
                <input type="password" wire:model="password_confirmation" id="password_confirmation" required
                    class="mt-2 block w-full rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    autocomplete="new-password">
                @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition">
                    {{ __('Update Password') }}
                </button>
                <div wire:loading wire:target="updatePassword">
                    <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Updating...') }}</span>
                </div>
            </div>

            @if (session('status') === 'password-updated')
                <div class="p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-800 dark:text-emerald-200">
                    {{ __('Password updated successfully!') }}
                </div>
            @endif
        </form>
    </div>
</div>
