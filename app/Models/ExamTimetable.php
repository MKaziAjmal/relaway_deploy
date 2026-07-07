<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamTimetable extends Model
{
    protected $table = 'exam_timetables';
    
    protected $fillable = [
        'exam_id',  // This references exam_types.id
        'academic_year_id',
        'school_class_id',
        'section_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room',
        'remarks',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    // Relationships
    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_id');  // Foreign key is exam_id
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'exam_timetable_id');
    }
}