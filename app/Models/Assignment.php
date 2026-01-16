<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'position',
    ];

    protected $guarded = ['id'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
