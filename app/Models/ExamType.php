<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $table = 'exam_types';
    
    protected $fillable = [
        'name',
        'description',
    ];

    public function examTimetables()
    {
        return $this->hasMany(ExamTimetable::class, 'exam_id');  // Foreign key is exam_id
    }
}