<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image_path',
        'description',
    ];


    public static function setSlug ($category) {
        $category->slug = Str::slug($category->name);
    }

    // automatically create slug from name
    public static function boot(){
        parent::boot();

        static::creating(fn ($category) => static::setSlug($category));

        static::updating(fn ($category) => static::setSlug($category));
    }
}
