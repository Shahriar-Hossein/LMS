<?php

namespace App\Livewire\Admin\Instructors;

use App\Models\User;
use App\Livewire\Admin\BaseComponent;

class Profile extends BaseComponent
{
    public User $instructor;
    public $courses = [];

    public function mount(User $instructor)
    {
        // Verify the user is an instructor
        if (!$instructor->hasRole('instructor')) {
            abort(404, 'Instructor not found');
        }

        $this->instructor = $instructor;
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $this->courses = $this->instructor
            ->courses()
            ->withCount(['modules', 'students', 'reviews'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.instructors.profile');
    }
}
