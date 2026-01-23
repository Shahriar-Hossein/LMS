<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Instructor\Settings\Profile as InstructorProfile;
use App\Livewire\Instructor\Settings\Password as InstructorPassword;
use App\Livewire\Student\Settings\Profile as StudentProfile;
use App\Livewire\Student\Settings\Password as StudentPassword;
// use App\Livewire\Instructor\Settings
use App\Livewire\Instructor\Dashboard as InstructorDashboard;
use App\Livewire\Instructor\Courses\Index as InstructorCourseIndex;
use App\Livewire\Instructor\Courses\Create as InstructorCourseCreate;
use App\Livewire\Instructor\Courses\Edit as InstructorCourseEdit;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Models\Course;
use App\Livewire\Instructor\Students\Index as InstructorStudentIndex;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Students\Index as AdminStudentIndex;
use App\Livewire\Admin\Instructors\Index as AdminInstructorIndex;
use App\Livewire\Admin\Courses\Index as AdminCourseIndex;
use App\Livewire\Admin\Categories\Index as AdminCategoryIndex;
use App\Livewire\Admin\Settings\Profile as AdminSettingsProfile;
use App\Livewire\Admin\Settings\Password as AdminPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// Public routes
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home');
// Static informational pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/help', 'pages.help')->name('help');
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    // Fallback for users who visit the enroll URL directly via GET (avoid 404)
    Route::get('/{course}/enroll', function (Course $course) {
        return redirect()->route('courses.show', $course->id);
    })->name('enroll.get');
    // Enroll in a course (students only) — handled via POST
    Route::post('/{course}/enroll', [CourseEnrollmentController::class, 'store'])->name('enroll')->middleware('auth');
});

// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', AdminCourseIndex::class)->name('index');
        });
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', AdminCategoryIndex::class)->name('index');
        });
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', AdminSettingsProfile::class)->name('profile');
            Route::get('/password', AdminPassword::class)->name('password');
        });
        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/', AdminStudentIndex::class)->name('index');
        });
        Route::prefix('instructors')->name('instructors.')->group(function () {
            Route::get('/', AdminInstructorIndex::class)->name('index');
        });
    });



// ==========================
// Instructor Routes
// ==========================
Route::middleware(['auth', 'role:instructor'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', InstructorDashboard::class)->name('dashboard');

        // Courses
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', InstructorCourseIndex::class)->name('index');
            Route::get('/create', InstructorCourseCreate::class)->name('create');
            Route::get('/{course}/edit', InstructorCourseEdit::class)->name('edit');
        });
        
        // Assignment grading routes
        Route::prefix('assignments')->name('assignments.')->group(function () {
            Route::get('/{course}/{assignment}/grade', \App\Livewire\Instructor\Courses\AssignmentGrader::class)->name('grade');
        });

        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/', InstructorStudentIndex::class)->name('index');
        });
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', InstructorProfile::class)->name('profile');
            Route::get('/password', InstructorPassword::class)->name('password');
        });
    });


// ==========================
// Student Routes (later)
// ==========================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        // Use Livewire student dashboard component instead of the old controller
        Route::get('/dashboard', \App\Livewire\Student\Dashboard::class)->name('dashboard');

        // Student courses: enrolled list and all courses
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', \App\Livewire\Student\EnrolledCourses::class)->name('index');
            Route::get('/all', \App\Livewire\Student\AllCourses::class)->name('all');
            Route::get('/{course}', \App\Livewire\Student\CourseView::class)->name('view');
        });

        // Student lessons
        Route::prefix('courses/{course}/lessons')->name('lessons.')->group(function () {
            Route::get('/{lesson}', \App\Livewire\Student\LessonView::class)->name('view');
        });

        // Student assignments
        Route::prefix('courses/{course}/assignments')->name('assignments.')->group(function () {
            Route::get('/{assignment}', \App\Livewire\Student\AssignmentView::class)->name('view');
        });

        // Student settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', StudentProfile::class)->name('profile');
            Route::get('/password', StudentPassword::class)->name('password');
        });
    });


// ==========================
// User Settings
// ==========================
Route::middleware(['auth'])->prefix('settings')->name('settings.')->group(function () {
    Route::redirect('/', 'settings/profile');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/password', Password::class)->name('password');
    Route::get('/appearance', Appearance::class)->name('appearance');
});


require __DIR__.'/auth.php';
