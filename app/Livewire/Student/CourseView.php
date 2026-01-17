<?php

namespace App\Livewire\Student;

use App\Models\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CourseView extends BaseComponent
{
    use AuthorizesRequests;

    public Course $course;
    public $modules = [];
    public $expandedModules = [];

    public function mount(Course $course)
    {
        // Check if user is enrolled in the course
        $user = Auth::user();
        if (!$user || !$user->courses()->where('courses.id', $course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        $this->course = $course;
        $this->loadModules();
    }

    public function loadModules()
    {
        $this->modules = $this->course->modules()
            ->with(['lessons', 'assignments'])
            ->get();
    }

    public function toggleModule($moduleId)
    {
        if (in_array($moduleId, $this->expandedModules)) {
            $this->expandedModules = array_filter($this->expandedModules, fn($id) => $id !== $moduleId);
        } else {
            $this->expandedModules[] = $moduleId;
        }
    }

    public function render()
    {
        return view('livewire.student.course-view');
    }
}
