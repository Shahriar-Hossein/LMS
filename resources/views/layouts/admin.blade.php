<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="min-h-screen bg-gradient-to-br from-cyan-50 via-emerald-50 to-white
             dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 flex">

    {{-- Sidebar --}}
    @include('partials.instructor.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        @include('partials.instructor.topnav')

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
