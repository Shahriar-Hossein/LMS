<?php

namespace App\Livewire\Student;

use App\Models\Assignment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseComponent
{
    public int $enrolledCount = 0;
    public float $totalSpent = 0.0;
    public float $overallProgress = 0.0;
    public int $completed = 0;
    public $courses;
    public $pendingAssignments;

    public function mount()
    {
        $user = Auth::user();

        if (! $user) {
            $this->courses = collect();
            $this->pendingAssignments = collect();
            return;
        }

        $this->enrolledCount = $user->enrolledCount();
        $this->totalSpent = $user->totalSpent();
        $this->overallProgress = $user->overallProgress();
        $this->completed = $user->completedCoursesCount();

        $this->courses = $user->courses()->withPivot('progress', 'completed_at', 'price_paid')->get();

        $courseIds = $this->courses->pluck('id')->toArray();

        $this->pendingAssignments = $courseIds ? Assignment::whereHas('module', function ($q) use ($courseIds) {
            $q->whereIn('course_id', $courseIds);
        })->get() : collect();
    }

    public function render()
    {
        return view('livewire.student.dashboard', [
            'enrolledCount' => $this->enrolledCount,
            'totalSpent' => $this->totalSpent,
            'overallProgress' => $this->overallProgress,
            'completed' => $this->completed,
            'courses' => $this->courses,
            'pendingAssignments' => $this->pendingAssignments,
        ]);
    }
}
