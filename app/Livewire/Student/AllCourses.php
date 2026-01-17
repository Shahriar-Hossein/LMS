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
        $this->enrolled = auth()->user()->courses()->pluck('id')->toArray();
    }

    public function enroll($courseId)
    {
        $user = auth()->user();
        if (! in_array($courseId, $this->enrolled)) {
            $user->courses()->attach($courseId);
            $this->enrolled[] = $courseId;
        }
    }

    public function render()
    {
        return view('livewire.student.all-courses');
    }
}
