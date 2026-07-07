<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $fillable = [
        'teacher_id',
        'school_class_id',
        'section_id',
        'subject_id',
        'academic_year_id'
    ];

    public function teacher()
{
    return $this->belongsTo(Teacher::class);
}

public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class);
}

public function section()
{
    return $this->belongsTo(Section::class);
}

public function subject()
{
    return $this->belongsTo(Subject::class);
}

public function academicYear()
{
    return $this->belongsTo(AcademicYear::class);
}}