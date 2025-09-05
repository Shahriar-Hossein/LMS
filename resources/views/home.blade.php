@extends('layouts.base')

@section('title', 'Home')

@section('content')

    @include('pages.home.hero')
    @include('pages.home.categories')

@endsection
