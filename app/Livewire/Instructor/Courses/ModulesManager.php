<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\Module as CourseModule;
use App\Models\Lesson;
use App\Models\Assignment;

class ModulesManager extends Component
{
    use WithFileUploads;

    public Course $course;

    public $modules = [];

    public $newModuleTitle = '';
    public $newModuleDescription = '';

    public $selectedModule = null;

    // Lesson fields
    public $lessonTitle = '';
    public $lessonDescription = '';
    public $lessonVideo;

    // Assignment fields
    public $assignmentTitle = '';
    public $assignmentDescription = '';
    public $assignmentFile;

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->loadModules();
    }

    protected function loadModules()
    {
        $this->modules = $this->course->modules()->with(['lessons', 'assignments'])->get();
    }

    public function createModule()
    {
        $this->validate([
            'newModuleTitle' => 'required|string|max:255',
            'newModuleDescription' => 'nullable|string',
        ]);

        $module = CourseModule::create([
            'course_id' => $this->course->id,
            'title' => $this->newModuleTitle,
            'description' => $this->newModuleDescription,
        ]);

        $this->newModuleTitle = '';
        $this->newModuleDescription = '';
        $this->loadModules();

        $this->dispatch('toast', message: 'Module created');
    }

    public function selectModule($moduleId)
    {
        $this->selectedModule = CourseModule::with(['lessons', 'assignments'])->find($moduleId);
        $this->resetContentFields();
    }

    protected function resetContentFields()
    {
        $this->lessonTitle = '';
        $this->lessonDescription = '';
        $this->lessonVideo = null;

        $this->assignmentTitle = '';
        $this->assignmentDescription = '';
        $this->assignmentFile = null;
    }

    public function createLesson()
    {
        $this->validate([
            'selectedModule' => 'required',
            'lessonTitle' => 'required|string|max:255',
            'lessonDescription' => 'nullable|string',
            'lessonVideo' => 'nullable|mimes:mp4,avi,mov|max:51200',
        ]);

        $videoPath = null;
        if ($this->lessonVideo) {
            $videoPath = $this->lessonVideo->store('lessons/videos', 'public');
        }

        Lesson::create([
            'module_id' => $this->selectedModule->id,
            'title' => $this->lessonTitle,
            'description' => $this->lessonDescription,
            'video_path' => $videoPath,
        ]);

        $this->selectModule($this->selectedModule->id);
        $this->dispatch('toast', message: 'Lesson added');
    }

    public function createAssignment()
    {
        $this->validate([
            'selectedModule' => 'required',
            'assignmentTitle' => 'required|string|max:255',
            'assignmentDescription' => 'nullable|string',
            'assignmentFile' => 'nullable|file|max:10240',
        ]);

        $filePath = null;
        $fileType = null;
        if ($this->assignmentFile) {
            $filePath = $this->assignmentFile->store('assignments/files', 'public');
            $fileType = $this->assignmentFile->getClientMimeType();
        }

        Assignment::create([
            'module_id' => $this->selectedModule->id,
            'title' => $this->assignmentTitle,
            'description' => $this->assignmentDescription,
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);

        $this->selectModule($this->selectedModule->id);
        $this->dispatch('toast', message: 'Assignment added');
    }

    public function render()
    {
        return view('livewire.instructor.courses.modules-manager');
    }
}
