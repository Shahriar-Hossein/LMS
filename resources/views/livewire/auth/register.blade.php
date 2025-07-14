<div class="flex flex-col gap-6">
    <x-auth.header
        :title="__('Create an account')"
        :description="__('Enter your details below to create your account')"
    />

    <!-- Session Status -->
    <x-auth-session-status
        class="text-center"
        :status="session('status')"
    />

    <form wire:submit="register" class="flex flex-col gap-6">
         {{-- Role --}}
        <div class="flex flex-col gap-1">
            <label for="role" class="text-sm font-medium text-cyan-900 dark:text-cyan-200">Register as</label>
            <select
                wire:model="role"
                required
                id="role"
                class="w-full rounded-md border border-cyan-300 bg-white dark:bg-cyan-950 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
            >
                <option value="" disabled selected hidden>Select a role</option>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>
        </div>

        {{-- Name --}}
        <div class="flex flex-col gap-1">
            <label for="name" class="text-sm font-medium text-cyan-900 dark:text-cyan-200">Name</label>
            <input
                wire:model="name"
                type="text"
                id="name"
                required
                autocomplete="name"
                placeholder="Full name"
                class="w-full rounded-md border border-cyan-300 bg-white dark:bg-cyan-950 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
            />
        </div>

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
        </div>

        {{-- Confirm Password --}}
        <div class="flex flex-col gap-1">
            <label for="password_confirmation" class="text-sm font-medium text-cyan-900 dark:text-cyan-200">Confirm password</label>
            <input
                wire:model="password_confirmation"
                type="password"
                id="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm password"
                class="w-full rounded-md border border-cyan-300 bg-white dark:bg-cyan-950 dark:text-white px-3 py-2 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
            />
        </div>

        {{-- Submit Button --}}
        <div>
            <button
                type="submit"
                class="w-full rounded-md bg-gradient-to-r from-cyan-500 to-emerald-600 hover:from-emerald-600 hover:to-cyan-700 text-white font-semibold py-2 transition-colors shadow-md"
            >
                Create account
            </button>
        </div>
    </form>

    {{-- Link to Login --}}
    <div class="text-center text-sm text-cyan-800 dark:text-cyan-200">
        Already have an account?
        <a href="{{ route('login') }}" wire:navigate class="text-emerald-600 hover:underline">
            Log in
        </a>
    </div>
</div>
