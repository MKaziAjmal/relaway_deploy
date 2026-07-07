<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'section_name',
        'description',
    ];

    public function classSections()
{
    return $this->hasMany(ClassSection::class);
}
}