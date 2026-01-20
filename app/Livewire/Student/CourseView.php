<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CourseView extends BaseComponent
{
    use AuthorizesRequests;

    public Course $course;
    public $modules = [];
    public $expandedModules = [];
    public $rating = 0;
    public $comment = '';
    public $userReview;
    public $reviews = [];

    public function mount(Course $course)
    {
        // Check if user is enrolled in the course
        $user = Auth::user();
        if (!$user || !$user->courses()->where('courses.id', $course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        $this->course = $course;
        $this->loadModules();
        $this->loadReviews();
    }

    public function loadModules()
    {
        $this->modules = $this->course->modules()
            ->with(['lessons', 'assignments'])
            ->get();
    }

    public function loadReviews(): void
    {
        $user = Auth::user();

        $this->reviews = $this->course
            ->reviews()
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        if ($user) {
            $this->userReview = $this->course
                ->reviews()
                ->where('user_id', $user->id)
                ->first();

            if ($this->userReview) {
                $this->rating = $this->userReview->rating;
                $this->comment = $this->userReview->comment;
            }
        }
    }

    public function toggleModule($moduleId)
    {
        if (in_array($moduleId, $this->expandedModules)) {
            $this->expandedModules = array_filter($this->expandedModules, fn($id) => $id !== $moduleId);
        } else {
            $this->expandedModules[] = $moduleId;
        }
    }

    public function setRating(int $value): void
    {
        if ($value < 1 || $value > 5) {
            return;
        }

        $this->rating = $value;
    }

    public function submitReview(): void
    {
        $user = Auth::user();

        if (! $user || ! $user->courses()->where('courses.id', $this->course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        $data = $this->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:2000',
        ]);

        CourseReview::updateOrCreate(
            [
                'course_id' => $this->course->id,
                'user_id'   => $user->id,
            ],
            $data
        );

        // Refresh relations and local state
        $this->course->refresh();
        $this->loadReviews();

        session()->flash('message', 'Your review has been saved.');
    }

    public function render()
    {
        return view('livewire.student.course-view');
    }
}
