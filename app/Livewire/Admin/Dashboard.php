<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;

class Dashboard extends Component
{
    public int $students = 0;
    public int $instructors = 0;
    public int $courses = 0;
    public int $assignments = 0;
    public float $revenue = 0.0;

    public function mount()
    {
        $this->students = User::role('student')->count();
        $this->instructors = User::role('instructor')->count();
        $this->courses = Course::count();
        $this->assignments = Assignment::count();

        // No payments table yet - keep revenue at 0.0
        $this->revenue = 0.0;
    }

    public function render()
    {
        return view('admin.dashboard', [
            'students' => $this->students,
            'instructors' => $this->instructors,
            'courses' => $this->courses,
            'assignments' => $this->assignments,
            'revenue' => $this->revenue,
        ]);
    }
}
