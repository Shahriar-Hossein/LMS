<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class AssignmentView extends BaseComponent
{
    use AuthorizesRequests, WithFileUploads;

    public Course $course;
    public Assignment $assignment;
    public $module;
    public $submission = null;
    public $submissionFile;
    public $submissionText = '';
    public $showSubmissionForm = false;

    public function mount(Course $course, Assignment $assignment)
    {
        // Check if user is enrolled in the course
        $user = Auth::user();
        if (!$user || !$user->courses()->where('courses.id', $course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        // Verify the assignment belongs to this course
        $this->assignment = $assignment;
        $this->module = $assignment->module;

        if ($this->module->course_id !== $course->id) {
            abort(404, 'Assignment not found in this course.');
        }

        $this->course = $course;
        $this->loadSubmission();
    }

    public function loadSubmission()
    {
        $user = Auth::user();
        $this->submission = AssignmentSubmission::where('assignment_id', $this->assignment->id)
            ->where('user_id', $user->id)
            ->first();

        if ($this->submission) {
            $this->submissionText = $this->submission->submission_text ?? '';
            $this->showSubmissionForm = false;
        } else {
            $this->showSubmissionForm = true;
        }
    }

    public function submitAssignment()
    {
        $user = Auth::user();

        $this->validate([
            'submissionFile' => 'nullable|file|max:10240',
            'submissionText' => 'nullable|string|max:5000',
        ]);

        if (!$this->submissionFile && !$this->submissionText) {
            $this->addError('submission', 'Please upload a file or enter text.');
            return;
        }

        $filePath = null;
        $fileType = null;

        if ($this->submissionFile) {
            $filePath = $this->submissionFile->store('submissions/assignments', 'public');
            $fileType = $this->submissionFile->getClientMimeType();
        }

        AssignmentSubmission::updateOrCreate(
            [
                'assignment_id' => $this->assignment->id,
                'user_id' => $user->id,
            ],
            [
                'file_path' => $filePath ?? null,
                'file_type' => $fileType ?? null,
                'submission_text' => $this->submissionText ?? null,
                'status' => 'submitted',
            ]
        );

        $this->loadSubmission();
        session()->flash('message', 'Assignment submitted successfully!');
    }

    public function resubmit()
    {
        $this->submissionFile = null;
        $this->submissionText = '';
        $this->showSubmissionForm = true;
    }

    public function render()
    {
        return view('livewire.student.assignment-view');
    }
}
