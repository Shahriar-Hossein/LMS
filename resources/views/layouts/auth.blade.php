<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="bg-emerald-50">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page-specific content --}}
    <main class="min-h-screen">
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
                <!-- form here -->
                {{ $slot }}
            </div>
        </div>
    </main>

    {{-- Add footer here when done --}}
</body>
</html>
