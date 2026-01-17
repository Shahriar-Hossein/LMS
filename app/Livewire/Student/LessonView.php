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
        // Get all lessons across all modules in order
        $this->allLessons = Lesson::whereHas('module', function($q) {
            $q->where('course_id', $this->course->id);
        })
        ->join('modules', 'lessons.module_id', '=', 'modules.id')
        ->orderBy('modules.position')
        ->orderBy('lessons.position')
        ->select('lessons.*')
        ->get();

        // Find current lesson index
        foreach ($this->allLessons as $index => $lessonItem) {
            if ($lessonItem->id === $this->lesson->id) {
                $this->currentIndex = $index;
                break;
            }
        }

        // Set next and previous lessons using array access
        /** @var array<int, Lesson> $lessonsArray */
        $lessonsArray = $this->allLessons->values()->all();
        if ($this->currentIndex > 0) {
            $this->prevLesson = $lessonsArray[$this->currentIndex - 1] ?? null;
        }
        if ($this->currentIndex < count($lessonsArray) - 1) {
            $this->nextLesson = $lessonsArray[$this->currentIndex + 1] ?? null;
        }
    }

    public function render()
    {
        return view('livewire.student.lesson-view');
    }
}
