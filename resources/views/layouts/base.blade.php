<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="bg-emerald-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page-specific content --}}
    @yield('content')


    {{-- Add footer here when done --}}
</body>
</html>
