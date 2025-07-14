<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="bg-emerald-50 dark:bg-zinc-800">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page-specific content --}}
    @yield('content')


    {{-- Add footer here when done --}}
</body>
</html>
