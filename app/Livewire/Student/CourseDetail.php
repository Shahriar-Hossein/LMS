<?php

namespace App\Livewire\Student;

use App\Models\Course;

class CourseDetail extends BaseComponent
{
    public Course $course;
    public bool $isEnrolled = false;

    public function mount(Course $course)
    {
        $this->course = $course->load(['modules.lessons', 'instructor', 'category']);
        $this->isEnrolled = auth()->user()->courses()->where('course_id', $course->id)->exists();
    }

    public function render()
    {
        return view('livewire.student.course-detail');
    }
}
