<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Instructor\Settings\Profile as InstructorProfile;
// use App\Livewire\Instructor\Settings
use App\Livewire\Instructor\Dashboard as InstructorDashboard;
use App\Livewire\Instructor\Courses\Index as InstructorCourseIndex;
use App\Livewire\Instructor\Courses\Create as InstructorCourseCreate;
use App\Livewire\Instructor\Courses\Edit as InstructorCourseEdit;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Livewire\Instructor\Students\Index as InstructorStudentIndex;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Students\Index as AdminStudentIndex;
use App\Livewire\Admin\Instructors\Index as AdminInstructorIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// Public routes
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
});

// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
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
        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/', InstructorStudentIndex::class)->name('index');
        });
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', InstructorProfile::class)->name('profile');
            // Route::get('/password', Password::class)->name('password');
            // Route::get('/appearance', Appearance::class)->name('appearance');
        });
    });


// ==========================
// Student Routes (later)
// ==========================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\StudentDashboardController::class, 'index'])->name('dashboard');
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
