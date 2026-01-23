<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use App\Livewire\Admin\BaseComponent;

class View extends BaseComponent
{
    public Course $course;
    public $modules = [];
    public $expandedModules = [];
    public $selectedStatus = '';
    public $availableStatuses = ['draft', 'review', 'published'];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->selectedStatus = $course->status;
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

    public function updateStatus()
    {
        if (!in_array($this->selectedStatus, $this->availableStatuses)) {
            $this->addError('selectedStatus', 'Invalid status selected');
            return;
        }

        $this->course->update(['status' => $this->selectedStatus]);
        session()->flash('message', 'Course status updated to ' . $this->selectedStatus);
    }

    public function render()
    {
        return view('livewire.admin.courses.view');
    }
}
