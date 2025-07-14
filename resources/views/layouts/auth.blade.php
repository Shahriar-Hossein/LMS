@extends('layouts.base')

@section('title', $title ?? 'SKillUp')

@section('content')
    <div class="min-h-screen">
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
                <!-- Logo -->
                <div class="flex justify-center">
                    <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                        <x-app-logo-icon class="size-9 fill-current text-emerald-500 dark:text-emerald-300" />
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                <!-- form here -->
                {{ $slot ?? '' }}
            </div>
        </div>
    </div>
@endsection
