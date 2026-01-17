<?php

namespace App\Livewire\Student;

class EnrolledCourses extends BaseComponent
{
    public $courses;

    public function mount()
    {
        $this->courses = auth()->user()->courses()->latest()->get();
    }

    public function render()
    {
        return view('livewire.student.enrolled-courses');
    }
}
