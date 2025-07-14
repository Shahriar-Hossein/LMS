@extends('layouts.base')

@section('title', $title ?? 'SkillUp')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-emerald-50 to-white dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900">
        <div class="flex justify-center items-center min-h-screen px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md rounded-2xl bg-white/80 dark:bg-zinc-900/80 shadow-xl backdrop-blur-md p-8 space-y-6 border border-emerald-100 dark:border-zinc-700">
                <!-- Logo -->
                <div class="flex justify-center">
                    <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                        <x-app-logo-icon class="size-10 fill-current text-emerald-600 dark:text-emerald-400" />
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <!-- Slot / Form Content -->
                {{ $slot ?? '' }}
            </div>
        </div>
    </div>
@endsection
