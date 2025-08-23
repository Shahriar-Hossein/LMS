<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use App\Models\Course;
use App\Livewire\Instructor\BaseComponent;

class Edit extends BaseComponent
{
    public Course $course;

    public $title;
    public $description;
    public $category_id;
    public $price;
    public $discount;
    public $status;

    public $categories;

    public function mount(Course $course)
    {
        $this->course = $course;

        // Initialize form fields
        $this->title = $course->title;
        $this->description = $course->description;
        $this->category_id = $course->category_id;
        $this->price = $course->price;
        $this->discount = $course->discount;
        $this->status = $course->status;

        // Load all categories
        $this->categories = \App\Models\Category::all();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:draft,published,pending',
        ]);

        $this->course->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Course updated successfully!');
    }

    public function render()
    {
        return view('livewire.instructor.courses.edit');
    }
}
