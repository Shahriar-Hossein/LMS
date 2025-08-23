<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Instructor\BaseComponent;

class Index extends BaseComponent
{
    public $courses;

    public function mount()
    {
        // Load instructor's courses
        $this->courses = Course::where('instructor_id', Auth::id())->get();
    }

    public function delete($id)
    {
        $course = Course::where('id', $id)
            ->where('instructor_id', Auth::id())
            ->firstOrFail();

        $course->delete();

        // Refresh course list
        $this->courses = Course::where('instructor_id', Auth::id())->get();

        session()->flash('message', 'Course deleted successfully.');
    }

    public function render()
    {
        return view('livewire.instructor.courses.index');
    }
}
