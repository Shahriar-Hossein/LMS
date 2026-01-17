<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    /**
     * Enroll the authenticated user in the given course.
     */
    public function store(Request $request, Course $course)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Avoid duplicate enrollments
        $already = $user->courses()->where('course_id', $course->id)->exists();
        if ($already) {
            return redirect()->back()->with('info', 'You are already enrolled in this course.');
        }

        // Attach with default pivot data (progress 0). Price/payment handled later.
        $user->courses()->syncWithoutDetaching([$course->id => ['progress' => 0]]);

        return redirect()->back()->with('success', 'Enrolled successfully.');
    }
}
