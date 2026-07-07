<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable = [
        'school_class_id',
        'subject_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}