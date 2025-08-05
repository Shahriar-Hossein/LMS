@if (Route::has('instructor.courses.index'))
    <a
        href="{{ route('instructor.courses.index') }}"
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium
               {{ request()->routeIs('instructor.courses.index') ? 'bg-cyan-600 text-white' : 'text-gray-700 hover:bg-cyan-100 hover:text-cyan-700 dark:text-gray-300 dark:hover:bg-cyan-700 dark:hover:text-white' }}"
        wire:navigate
    >
        <x-icon name="book-open" class="w-5 h-5 mr-2" />
        {{ __('All Courses') }}
    </a>
@else
    <span
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed opacity-60"
        title="{{ __('Route not available') }}"
    >
        <x-icon name="book-open" class="w-5 h-5 mr-2" />
        {{ __('All Courses') }}
    </span>
@endif

@if (Route::has('instructor.courses.create'))
    <a
        href="{{ route('instructor.courses.create') }}"
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium
               {{ request()->routeIs('instructor.courses.create') ? 'bg-cyan-600 text-white' : 'text-gray-700 hover:bg-cyan-100 hover:text-cyan-700 dark:text-gray-300 dark:hover:bg-cyan-700 dark:hover:text-white' }}"
        wire:navigate
    >
        <x-icon name="plus" class="w-5 h-5 mr-2" />
        {{ __('Create Course') }}
    </a>
@else
    <span
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed opacity-60"
        title="{{ __('Route not available') }}"
    >
        <x-icon name="plus" class="w-5 h-5 mr-2" />
        {{ __('Create Course') }}
    </span>
@endif

@if (Route::has('instructor.my-students'))
    <a
        href="{{ route('instructor.my-students') }}"
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium
               {{ request()->routeIs('instructor.courses.create') ? 'bg-cyan-600 text-white' : 'text-gray-700 hover:bg-cyan-100 hover:text-cyan-700 dark:text-gray-300 dark:hover:bg-cyan-700 dark:hover:text-white' }}"
        wire:navigate
    >
        <x-icon name="plus" class="w-5 h-5 mr-2" />
        {{ __('My Students') }}
    </a>
@else
    <span
        class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-400 cursor-not-allowed opacity-60"
        title="{{ __('Route not available') }}"
    >
        <x-icon name="plus" class="w-5 h-5 mr-2" />
        {{ __('My Students') }}
    </span>
@endif

