<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="bg-gray-100 flex h-screen">

    {{-- sidebar --}}
    @include('partials.instructor.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        @include('partials.instructor.topnav')

        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts

    {{-- Add footer here when done --}}
</body>
</html>
