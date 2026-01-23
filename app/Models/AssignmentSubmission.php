<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'file_path',
        'file_type',
        'submission_text',
        'grade',
        'feedback',
        'graded_at',
        'graded_by',
        'status',
    ];

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'id'              => 'integer',
            'assignment_id'   => 'integer',
            'user_id'         => 'integer',
            'grade'           => 'integer',
            'graded_by'       => 'integer',
            'graded_at'       => 'datetime',
            'created_at'      => 'datetime',
            'updated_at'      => 'datetime',
        ];
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by');
    }

    public function isGraded()
    {
        return $this->graded_at !== null;
    }
}
