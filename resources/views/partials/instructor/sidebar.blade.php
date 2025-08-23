<aside class="w-64 bg-white border-r shadow h-screen">
    <div class="p-4 font-bold text-lg">Instructor Panel</div>
    <nav class="space-y-2">
        <a href="{{ route('instructor.dashboard') }}" class="block p-2 hover:bg-gray-100">Dashboard</a>
        <a href="{{ route('instructor.courses.index') }}" class="block p-2 hover:bg-gray-100">My Courses</a>
        <a href="{{ route('instructor.students.index') }}" class="block p-2 hover:bg-gray-100">Students</a>
        <a href="{{ route('instructor.settings') }}" class="block p-2 hover:bg-gray-100">Settings</a>
    </nav>
</aside>
