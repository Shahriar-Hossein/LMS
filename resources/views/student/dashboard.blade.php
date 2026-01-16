@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Student Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Enrolled</div>
            <div class="text-2xl font-semibold">{{ $enrolledCount }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Total Spent</div>
            <div class="text-2xl font-semibold">{{ number_format($totalSpent, 2) }}</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Overall Progress</div>
            <div class="text-2xl font-semibold">{{ $overallProgress }}%</div>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <div class="text-sm text-gray-500">Completed Courses</div>
            <div class="text-2xl font-semibold">{{ $completed }}</div>
        </div>
    </div>

    <div class="bg-white rounded shadow">
        <div class="border-b p-3 flex items-center gap-4">
            <a href="#tab-courses" class="text-sm font-medium">Enrolled Courses</a>
            <a href="#tab-profile" class="text-sm font-medium">Profile</a>
            <a href="#tab-assignments" class="text-sm font-medium">Pending Assignments</a>
        </div>

        <div id="tab-courses" class="p-4">
            <h2 class="font-semibold mb-3">My Enrolled Courses</h2>
            @if($courses->isEmpty())
                <div class="text-gray-500">You are not enrolled in any courses yet.</div>
            @else
                <ul class="space-y-3">
                    @foreach($courses as $course)
                        <li class="p-3 border rounded flex items-center justify-between">
                            <div>
                                <div class="font-medium">{{ $course->title }}</div>
                                <div class="text-sm text-gray-500">@if(isset($course->pivot) && isset($course->pivot->progress)) Progress: {{ $course->pivot->progress }}% @endif</div>
                            </div>
                            <div>
                                <a href="{{ route('courses.show', $course) }}" class="text-cyan-600">Open</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div id="tab-profile" class="p-4">
            <h2 class="font-semibold mb-3">Profile</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-3 border rounded">
                    <div class="text-sm text-gray-500">Name</div>
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                </div>
                <div class="p-3 border rounded">
                    <div class="text-sm text-gray-500">Email</div>
                    <div class="font-medium">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>

        <div id="tab-assignments" class="p-4">
            <h2 class="font-semibold mb-3">Pending Assignments</h2>
            @if($pendingAssignments->isEmpty())
                <div class="text-gray-500">No pending assignments.</div>
            @else
                <ul class="space-y-3">
                    @foreach($pendingAssignments as $a)
                        <li class="p-3 border rounded">
                            <div class="font-medium">{{ $a->title }}</div>
                            <div class="text-sm text-gray-500">Module: {{ optional($a->module)->title ?? '—' }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection
