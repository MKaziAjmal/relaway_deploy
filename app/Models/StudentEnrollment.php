<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    protected $fillable = [
        'student_id',
        'academic_year_id',
        'class_section_id',
        'roll_no',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classSection()
    {
        return $this->belongsTo(ClassSection::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}