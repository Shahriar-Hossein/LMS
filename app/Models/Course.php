<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\ActiveScope;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'id'            => 'integer',
            'instructor_id' => 'integer',
            'category_id'   => 'integer',
            'title'         => 'string',
            'slug'          => 'string',
            'price'         => 'integer',
            'discount'      => 'integer',
            'status'        => 'string',
            'description'   => 'string',
            'banner_path'   => 'string',
            'video_path'    => 'string',
            'published_at'  => 'datetime',
            'created_at'    => 'datetime',
            'updated_at'    => 'datetime',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // get published courses
    public function scopePublished($query) {
        return $query->where('status', 'published');
    }

    /**
     * Set unique slug for the course.
     * - Use title if unique
     * - Append ID if there's a conflict
     */
    public static function setSlug ($course) {
        $slug = Str::slug($course->title);

        if (
            static::where('slug', $slug)
                ->when( $course->exists,
                    fn($q) => $q->where('id', '<>', $course->id)
                )->exists()
        ) {
            $slug .= '-' . $course->id;
        }

        $course->slug = $slug;
    }

    // automatically create slug from title
    public static function boot(){
        parent::boot();

        // Globally add for all query.
        // static::addGlobalScope(new \App\Models\Scopes\ActiveScope);

        static::created(function ($course) {
            static::setSlug($course);
            $course->save();
        });
        // only change slug if title was updated.
        static::updating(fn ($course) => $course->isDirty('title') ? static::setSlug($course) : null);
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
