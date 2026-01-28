<?php

namespace App\Livewire\Student;

use App\Models\Course;

class AllCourses extends BaseComponent
{
    public $courses;
    public $enrolled = [];

    public function mount()
    {
        $this->courses = Course::published()->latest()->get();
        $this->enrolled = auth()->user()->courses()->pluck('courses.id')->toArray();
    }

    public function render()
    {
        return view('livewire.student.all-courses');
    }
}
