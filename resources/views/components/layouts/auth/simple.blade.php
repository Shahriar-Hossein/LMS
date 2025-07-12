<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>

    <body
        class="relative min-h-screen bg-no-repeat bg-cover antialiased"
        style="background-image: url('{{ asset('images/registration_background.jpeg') }}');"
    >
        <!-- Backdrop layer -->
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 to-emerald-500/20 backdrop-blur-xs"></div>

        <!-- Registration container -->
        <div class="relative z-10 flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-md rounded-3xl backdrop-blur-3xl bg-background p-6 px-16 shadow-xl">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <x-app-logo-icon class="size-9 fill-current text-emerald-500 dark:text-emerald-300" />
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <!-- Dynamic content slot -->
                <div class="mt-6 flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
