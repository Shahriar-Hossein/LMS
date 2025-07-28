<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700 p-4 flex flex-col justify-between">
            <div>
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center mb-6 space-x-2 rtl:space-x-reverse" wire:navigate>
                    <x-app-logo class="h-8 w-auto" />
                </a>
                {{-- Name of the dashboard admin | instructor | student--}}
                <div class="flex items-center mb-4 gap-2">
                    <span class="text-lg font-semibold text-cyan-900 dark:text-cyan-100">
                        {{ __( ucfirst(auth()->user()->getRoleNames()->first()) ) }} Panel
                    </span>

                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-100">
                        {{ auth()->user()->getRoleNames()->first() }}
                    </span>
                </div>


                <!-- Navigation -->
                <nav class="space-y-2">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{ __('Platform') }}</p>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('dashboard') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Courses') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Manage Courses') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('New Courses') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Enrollments') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Student Enrollments') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Instructors') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Students') }}
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium rounded-md
                                  {{ request()->routeIs('Course') ? 'bg-zinc-200 dark:bg-zinc-700 text-black dark:text-white' : 'text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800' }}"
                           wire:navigate>
                            <x-icon name="home" class="w-4 h-4 mr-2" />
                            {{ __('Reports & Analytics') }}
                        </a>
                        
                    </div>
                </nav>
            </div>

            <!-- Bottom links -->
            <div class="space-y-2">
                <a href="https://github.com/laravel/livewire-starter-kit" target="_blank"
                   class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800">
                    <x-icon name="folder-git-2" class="w-4 h-4 mr-2" />
                    {{ __('Repository') }}
                </a>
                <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank"
                   class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800">
                    <x-icon name="book-open-text" class="w-4 h-4 mr-2" />
                    {{ __('Documentation') }}
                </a>

                <!-- User Info -->
                <div class="mt-4 border-t pt-4 dark:border-zinc-700">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-full bg-neutral-300 dark:bg-neutral-700 flex items-center justify-center text-sm font-semibold text-white">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="mt-2 space-y-1">
                        <a href="{{ route('settings.profile') }}"
                           class="block px-3 py-2 text-sm text-gray-700 hover:bg-zinc-100 dark:text-gray-300 dark:hover:bg-zinc-800"
                           wire:navigate>
                            <x-icon name="cog" class="w-4 h-4 inline-block mr-2" />
                            {{ __('Settings') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-100 dark:hover:bg-red-900 cursor-pointer">
                                <x-icon name="arrow-right-start-on-rectangle" class="w-4 h-4 inline-block mr-2" />
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireScripts
</body>
</html>
