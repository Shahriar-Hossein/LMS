<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'gender',
        'address',
        'image_path',
        'occupation',
        'organization',
        'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Courses the user is enrolled in (many-to-many pivot expected)
     */
    public function courses(): BelongsToMany
    {
        // explicit pivot table name for clarity (course_student)
        return $this->belongsToMany(Course::class, 'course_student')->withTimestamps();
    }

    public function enrolledCount(): int
    {
        return $this->courses()->count();
    }

    /**
     * Estimate total spent. If there's a `price_paid` pivot column it will be used by consumer
     * otherwise sum course prices as a fallback.
     */
    public function totalSpent(): int
    {
        // try to sum price_paid from pivot when loaded
        $courses = $this->courses()->get();
        if ($courses->isEmpty()) {
            return 0;
        }

        // if pivot has price_paid use that; otherwise sum course price
        $sum = 0;
        foreach ($courses as $c) {
            if (isset($c->pivot) && isset($c->pivot->price_paid)) {
                $sum += (int) $c->pivot->price_paid;
            } else {
                $sum += (int) ($c->price ?? 0);
            }
        }

        return $sum;
    }

    /**
     * Average progress across enrolled courses.
     * Expects an optional `progress` pivot value (0-100). Falls back to 0.
     */
    public function overallProgress(): float
    {
        $courses = $this->courses()->get();
        if ($courses->isEmpty()) {
            return 0;
        }

        $sum = 0;
        $count = 0;
        foreach ($courses as $c) {
            $count++;
            $sum += isset($c->pivot) && isset($c->pivot->progress) ? (float) $c->pivot->progress : 0;
        }

        return $count ? round($sum / $count, 2) : 0;
    }

    public function completedCoursesCount(): int
    {
        $courses = $this->courses()->get();
        if ($courses->isEmpty()) {
            return 0;
        }

        $completed = 0;
        foreach ($courses as $c) {
            if (isset($c->pivot) && ! empty($c->pivot->completed_at)) {
                $completed++;
            }
        }

        return $completed;
    }

    /**
     * Reviews the user has written for courses.
     */
    public function courseReviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }

    /**
     * Assignment submissions from this user (as a student).
     */
    public function assignmentSubmissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class, 'user_id');
    }

    /**
     * Assignment submissions graded by this user (as an instructor).
     */
    public function gradedSubmissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class, 'graded_by');
    }
}
