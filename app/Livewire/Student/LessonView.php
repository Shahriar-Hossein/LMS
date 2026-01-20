<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class LessonView extends BaseComponent
{
    use AuthorizesRequests;

    public Course $course;
    public Lesson $lesson;
    public $module;
    public $allLessons = [];
    public $currentIndex = 0;
    public $nextLesson = null;
    public $prevLesson = null;

    public function mount(Course $course, Lesson $lesson)
    {
        // Check if user is enrolled in the course
        $user = Auth::user();
        if (!$user || !$user->courses()->where('courses.id', $course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        // Verify the lesson belongs to this course
        $this->lesson = $lesson;
        $this->module = $lesson->module;

        if ($this->module->course_id !== $course->id) {
            abort(404, 'Lesson not found in this course.');
        }

        $this->course = $course;
        
        // Get all lessons for navigation
        $this->loadLessonsForNavigation();
    }

    public function loadLessonsForNavigation()
    {
        // Load modules with lessons (both relations already order by `position`) and
        // flatten lessons preserving module order so navigation matches the sidebar.
        $modules = $this->course->modules()->with('lessons')->get();

        $this->allLessons = collect();
        foreach ($modules as $mod) {
            foreach ($mod->lessons as $l) {
                $this->allLessons->push($l);
            }
        }

        // Find current lesson index (cast ids to int to avoid strict type issues)
        $this->currentIndex = 0;
        foreach ($this->allLessons as $index => $lessonItem) {
            if ((int) $lessonItem->id === (int) $this->lesson->id) {
                $this->currentIndex = $index;
                break;
            }
        }

        $lessonsArray = $this->allLessons->values()->all();
        $this->prevLesson = $this->currentIndex > 0 ? $lessonsArray[$this->currentIndex - 1] : null;
        $this->nextLesson = $this->currentIndex < count($lessonsArray) - 1 ? $lessonsArray[$this->currentIndex + 1] : null;
    }

    public function render()
    {
        return view('livewire.student.lesson-view');
    }
}
