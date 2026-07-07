<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_id',
        'exam_timetable_id',
        'subject_id',
        'total_marks',
        'obtained_marks',
        'remarks',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function examTimetable()
    {
        return $this->belongsTo(ExamTimetable::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}