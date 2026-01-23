<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class AssignmentGrader extends \App\Livewire\Instructor\BaseComponent
{
    public Course $course;
    public Assignment $assignment;
    public $submissions = [];
    public $selectedSubmission = null;
    public $selectedStudentId = null;

    // Grading fields
    public $grade = '';
    public $feedback = '';

    public function mount(Course $course, Assignment $assignment)
    {
        // Check if user is the instructor or admin
        $user = Auth::user();
        if ($user->id !== $course->instructor_id && !$user->hasRole('admin')) {
            abort(403, 'Unauthorized to grade assignments for this course.');
        }

        // Verify assignment belongs to course
        if ($assignment->module->course_id !== $course->id) {
            abort(404, 'Assignment not found in this course.');
        }

        $this->course = $course;
        $this->assignment = $assignment;
        $this->loadSubmissions();
    }

    public function loadSubmissions()
    {
        $this->submissions = AssignmentSubmission::where('assignment_id', $this->assignment->id)
            ->with('student')
            ->orderByDesc('updated_at')
            ->get();
    }

    public function selectSubmission($submissionId)
    {
        $this->selectedSubmission = AssignmentSubmission::with(['student', 'grader'])
            ->find($submissionId);
        
        if ($this->selectedSubmission) {
            $this->selectedStudentId = $this->selectedSubmission->user_id;
            $this->grade = $this->selectedSubmission->grade ?? '';
            $this->feedback = $this->selectedSubmission->feedback ?? '';
        }
    }

    public function submitGrade()
    {
        if (!$this->selectedSubmission) {
            return;
        }

        $this->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'required|string|min:5|max:5000',
        ]);

        $this->selectedSubmission->update([
            'grade' => $this->grade,
            'feedback' => $this->feedback,
            'graded_at' => now(),
            'graded_by' => Auth::id(),
            'status' => 'graded',
        ]);

        $this->loadSubmissions();
        $this->dispatch('toast', message: 'Grade submitted successfully!');
        $this->selectedSubmission = null;
        $this->resetGradingFields();
    }

    protected function resetGradingFields()
    {
        $this->grade = '';
        $this->feedback = '';
    }

    public function getSubmissionStatusColor($status)
    {
        return match($status) {
            'submitted' => 'yellow',
            'graded' => 'green',
            'resubmitted' => 'blue',
            default => 'gray',
        };
    }

    public function render()
    {
        return view('livewire.instructor.courses.assignment-grader');
    }
}
