<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'admission_no',
        'gender',
        'date_of_birth',
        'phone',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    // Accessor to get roll number from enrollment
    public function getRollNoAttribute()
    {
        $enrollment = $this->enrollments()->latest()->first();
        return $enrollment ? $enrollment->roll_no : null;
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}