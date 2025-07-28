<div class="flex flex-col gap-6">
    <x-auth.header
        :title="__('Welcome back!')"
        :description="__('Enter your email and password below to log in')"
    />

    <!-- Session Status -->
    <x-auth-session-status
        class="text-center"
        :status="session('status')"
    />

    <form wire:submit="login" class="flex flex-col gap-6">
        {{-- Email --}}
        <div class="flex flex-col gap-1">
            <label for="email" class="text-sm font-medium text-cyan-900 dark:text-cyan-200">Email address</label>
            <input
                wire:model="email"
                type="email"
                id="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full rounded-md border border-cyan-300 bg-white dark:bg-cyan-950 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
            />
            @error('email')
                <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror

        </div>

        {{-- Password --}}
        <div class="flex flex-col gap-1">
            <label for="password" class="text-sm font-medium text-cyan-900 dark:text-cyan-200">Password</label>
            <input
                wire:model="password"
                type="password"
                id="password"
                required
                autocomplete="new-password"
                placeholder="Password"
                class="w-full rounded-md border border-cyan-300 bg-white dark:bg-cyan-950 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
            />
            @error('password')
                <span class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
            
        </div>

        @if (Route::has('password.request'))
            <a class="text-emerald-600 hover:underline text-sm" :href="route('password.request')" wire:navigate>
                {{ __('Forgot your password?') }}
            </a>
        @endif

        {{-- Submit Button --}}
        <div>
            <button
                type="submit"
                class="w-full rounded-md bg-gradient-to-r from-cyan-500 to-emerald-600 hover:from-emerald-600 hover:to-cyan-700 text-white font-semibold py-2 transition-colors duration-300 ease-in shadow-md cursor-pointer"
            >
                Log in
            </button>
        </div>
    </form>

    {{-- Link to registration page --}}
    @if (Route::has('register'))
        <div class="text-center text-sm text-cyan-800 dark:text-cyan-200">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}" wire:navigate class="text-emerald-600 hover:underline">
                {{ __('Sign up') }}
            </a>
        </div>
    @endif
</div>
