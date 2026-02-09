<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function courseSubjects()
    {
        return $this->hasMany(CourseSubject::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subject_users');
    }
}
