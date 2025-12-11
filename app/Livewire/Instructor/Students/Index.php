<?php

namespace App\Livewire\Instructor\Students;

use App\Livewire\Instructor\BaseComponent;
use App\Models\User;

class Index extends BaseComponent
{
    public $students;
    
    public function mount()
    {
        // studetns that are enrolled in courses made by this instructor
        // $this->students = User::where('role', 'student')->whereHas('courses', function ($query) {
        //     $query->where('instructor_id', auth()->user()->id);
        // })->get();
        // $this->students = User::where('role', 'student')->get();
    }
    public function render()
    {
        return view('livewire.instructor.students.index');
    }
}
