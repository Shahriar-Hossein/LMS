<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use App\Models\Course;
use App\Livewire\Instructor\BaseComponent;
use Livewire\WithFileUploads;

class Edit extends BaseComponent
{
    use WithFileUploads;

    public Course $course;

    public string $title = '';
    public string $description = '';
    public ?int $price = 0;
    public ?int $discount = 0;
    public ?int $category_id = null;
    public string $status = 'draft';

    public $banner; // new upload
    public $video;  // new upload

    public $existingBanner; // keep existing file path
    public $existingVideo;

    public $categories;

    public function mount(Course $course)
    {
        $this->course = $course;

        // Initialize form fields
        $this->title         = $course->title;
        $this->description   = $course->description;
        $this->category_id   = $course->category_id;
        $this->price         = $course->price ?? $this->price;
        $this->discount      = $course->discount ?? $this->discount;
        $this->status        = $course->status ?? $this->status;

        // Existing files
        $this->existingBanner = $course->banner_path;
        $this->existingVideo  = $course->video_path;

        // Load all categories
        $this->categories = \App\Models\Category::all();
    }

    public function update()
    {
        $this->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'nullable|numeric|min:0',
            'discount'     => 'nullable|numeric|min:0|max:100',
            'status'       => 'required|in:draft,published,pending',
            'banner'       => 'nullable|image|max:5120', // optional, max 5MB
            'video'        => 'nullable|mimes:mp4,avi,mov|max:51200', // optional, max 50MB
        ]);

         // Handle banner
        $bannerPath =
            $this->banner
                ? $this->banner->store('courses/banners', 'public')
                : $this->existingBanner;

        // Handle video
        $videoPath =
            $this->video
                ? $this->video->store('courses/videos', 'public')
                : $this->existingVideo;

        $this->course->update([
            'title'       => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price'       => $this->price,
            'discount'    => $this->discount,
            'status'      => $this->status,
            'banner_path' => $bannerPath,
            'video_path'  => $videoPath,
        ]);

         // Reset file inputs if new files were uploaded
        if ($this->banner) {
            $this->existingBanner = $bannerPath;
            $this->banner = null;
        }
        if ($this->video) {
            $this->existingVideo = $videoPath;
            $this->video = null;
        }

        $this->dispatch('toast', message: 'Course updated successfully!');
        // return redirect()->route('instructor.courses.edit', $this->course);
    }

    public function render()
    {
        return view('livewire.instructor.courses.edit');
    }
}
