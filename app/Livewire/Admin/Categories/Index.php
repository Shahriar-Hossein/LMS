<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Livewire\Admin\BaseComponent;

class Index extends BaseComponent
{
    use WithPagination;

    public $search = '';
    public $showCreate = false;
    public $newName = '';
    public $editingId = null;
    public $editingName = '';

    protected $queryString = ['search'];

    protected $rules = [
        'newName' => 'required|string|max:255',
        'editingName' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleCreate()
    {
        $this->showCreate = ! $this->showCreate;
        if (! $this->showCreate) {
            $this->newName = '';
        }
    }

    public function create()
    {
        $this->validateOnly('newName');

        Category::create(['name' => $this->newName]);

        $this->newName = '';
        $this->showCreate = false;
    }

    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        $this->editingId = $id;
        $this->editingName = $cat->name;
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->editingName = '';
    }

    public function update()
    {
        $this->validateOnly('editingName');

        $cat = Category::findOrFail($this->editingId);
        $cat->update(['name' => $this->editingName]);

        $this->cancelEdit();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function render()
    {
        $categories = Category::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.categories.index', compact('categories'));
    }
}
