@extends('layouts.base')

@section('title', $title ?? 'SKillUp')

@section('content')
    <div class="min-h-screen">
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
                <!-- form here -->
                {{ $slot ?? '' }}
            </div>
        </div>
    </div>
@endsection
