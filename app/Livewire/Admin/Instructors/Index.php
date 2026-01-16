<?php

namespace App\Livewire\Admin\Instructors;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
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
        $instructors = User::role('instructor')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.instructors.index', compact('instructors'));
    }
}
