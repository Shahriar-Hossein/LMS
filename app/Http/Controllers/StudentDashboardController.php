<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $enrolledCount = $user->enrolledCount();
        $totalSpent = $user->totalSpent();
        $overallProgress = $user->overallProgress();
        $completed = $user->completedCoursesCount();

        // Enrolled courses list
        $courses = $user->courses()->with('modules')->get();

        // Pending assignments: collect assignments from enrolled courses' modules
        $moduleIds = $courses->flatMap(fn($c) => $c->modules->pluck('id'))->unique()->values();
        $pendingAssignments = Assignment::whereIn('module_id', $moduleIds)->get();

        return view('student.dashboard', compact(
            'enrolledCount',
            'totalSpent',
            'overallProgress',
            'completed',
            'courses',
            'pendingAssignments'
        ));
    }
}
