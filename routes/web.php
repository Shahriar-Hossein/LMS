<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Instructor\Dashboard as InstructorDashboard;
use App\Livewire\Instructor\Courses\Index as InstructorCourseIndex;
use App\Livewire\Instructor\Courses\Create as InstructorCourseCreate;
use App\Livewire\Instructor\Courses\Edit as InstructorCourseEdit;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;

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
// Admin Routes (later)
// ==========================


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
    });


// ==========================
// Student Routes (later)
// ==========================


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
