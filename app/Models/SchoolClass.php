<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = [
        'class_name',
        'description',
    ];

    /**
     * A class can have many sections.
     */
    public function classSections()
    {
        return $this->hasMany(ClassSection::class);
    }
    public function subjects()
{
    return $this->belongsToMany(Subject::class, 'class_subjects');
}
}