<?php

namespace App\Livewire\Admin\Students;

use App\Models\User;
use App\Livewire\Admin\BaseComponent;

class Profile extends BaseComponent
{
    public User $student;
    public $enrolledCourses = [];

    public function mount(User $student)
    {
        // Verify the user is a student
        if (!$student->hasRole('student')) {
            abort(404, 'Student not found');
        }

        $this->student = $student;
        $this->loadEnrolledCourses();
    }

    public function loadEnrolledCourses()
    {
        $this->enrolledCourses = $this->student
            ->courses()
            ->with(['instructor', 'category'])
            ->withCount(['modules', 'reviews'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.students.profile');
    }
}
