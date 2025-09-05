<!-- Very little is needed to make a happy life. - Marcus Aurelius -->
@extends('layouts.base')

@section('title', 'Courses')

@section('content')

    @include('pages.courses.featured-courses', ['courses' => $courses])
    @include('pages.courses.courses')

@endsection
