{{-- Make app specific layout from the base layout if needed --}}
@extends('layouts.base')

@section('title', $title ?? 'SKillUp')

@section('content')
    {{ $slot ?? '' }}
@endsection
