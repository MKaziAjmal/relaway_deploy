<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    protected $fillable = [
        'school_class_id',
        'section_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function enrollments()
{
    return $this->hasMany(StudentEnrollment::class);
}
}