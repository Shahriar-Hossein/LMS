<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('instructor')
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('pages.courses.index', compact('courses', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(['instructor', 'modules']);
        $course->loadCount(['reviews']);

        $averageRating = $course->averageRating();
        $reviews = $course->reviews()
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('pages.course.index', compact('course', 'averageRating', 'reviews'));
    }
}
