<?php

namespace App\Livewire\Admin\Courses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Livewire\Admin\BaseComponent;

class Index extends BaseComponent
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $courses = Course::with(['instructor', 'category'])
            ->withCount(['modules', 'students'])
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%")
                ->orWhereHas('instructor', fn($q2) => $q2->where('name', 'like', "%{$this->search}%")))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.courses.index', compact('courses'));
    }
}
