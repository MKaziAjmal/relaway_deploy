<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    
    protected $fillable = [
        'subject_name',
        'subject_code',  // Add this if it exists
        'description',
        'total_marks',
    ];

    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subjects', 'subject_id', 'school_class_id');
    }

    public function examTimetables()
    {
        return $this->hasMany(ExamTimetable::class, 'subject_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'subject_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'teacher_id');
    }
}