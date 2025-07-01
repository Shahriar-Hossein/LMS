<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'slug',
        'price',
        'discount',
        'status',
        'description',
        'banner_path',
        'video_path',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public static function setSlug ($course) {
        $course->slug = Str::slug($course->title);
    }

    // automatically create slug from title
    public static function boot(){
        parent::boot();

        static::creating(fn ($course) => static::setSlug($course));
        // only change slug if title was updated.
        static::updating(fn ($course) => $course->isDirty('title') && static::setSlug($course));
    }



    /**
     * Get the instructor that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor (): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the category that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
