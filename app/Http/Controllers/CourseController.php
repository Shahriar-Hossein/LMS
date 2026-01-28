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
    public function index(Request $request)
    {
        $query = Course::with('instructor')
            ->withCount(['modules', 'reviews', 'students as enrolled_count'])
            ->published();

        // Search (title, description, instructor name)
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('instructor', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category filter (array of ids)
        if ($categories = $request->query('categories')) {
            if (is_array($categories)) {
                $query->whereIn('category_id', $categories);
            }
        }

        // Price ranges
        if ($price = $request->query('price')) {
            switch ($price) {
                case 'free':
                    $query->where('price', 0);
                    break;
                case '0-500':
                    $query->whereBetween('price', [1, 500]);
                    break;
                case '501-1000':
                    $query->whereBetween('price', [501, 1000]);
                    break;
                case '1001-2000':
                    $query->whereBetween('price', [1001, 2000]);
                    break;
                case '2001-5000':
                    $query->whereBetween('price', [2001, 5000]);
                    break;
                case '>5000':
                    $query->where('price', '>', 5000);
                    break;
            }
        }

        // Sorting
        $sort = $request->query('sort');
        switch ($sort) {
            case 'latest':
                $query->orderBy('published_at', 'desc');
                break;
            case 'popular':
                $query->orderByDesc('enrolled_count');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $courses = $query->paginate(12)->withQueryString();

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
