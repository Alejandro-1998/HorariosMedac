<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function courseSubjects()
    {
        return $this->hasMany(CourseSubject::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subjects');
    }
}
