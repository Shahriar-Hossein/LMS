<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use App\Livewire\Instructor\BaseComponent;
use Livewire\WithFileUploads;

class Create extends BaseComponent
{
    use WithFileUploads;

    public string $title = '';
    public string $description = '';
    public ?int $price = 0;
    public ?int $discount = 0;
    public ?int $category_id = null;

    public $banner;
    public $video;

    public function save()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255', 'unique:courses,title'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'discount' => ['nullable', 'integer', 'min:0', 'max:100'],
            'category_id' => ['nullable', Rule::exists('categories', 'id')],
            'banner' => ['nullable', 'image', 'max:2048'],
            'video' => ['nullable', 'mimes:mp4,avi,mov,mkv', 'max:51200'],
        ]);

        $bannerPath = $this->banner ? $this->banner->store('courses/banners', 'public') : null;
        $videoPath = $this->video ? $this->video->store('courses/videos', 'public') : null;

        $course = Course::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'category_id' => $this->category_id,
            'instructor_id' => Auth::id(),
            'banner_path' => $bannerPath,
            'video_path' => $videoPath,
            'status' => 'draft',
        ]);

        session()->flash('success', 'Course created successfully.');
        return redirect()->route('instructor.courses.edit', $course);
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.instructor.courses.create', [
            'categories' => $categories,
        ]);
    }
}
