<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $guarded = [];

    public function scheduleEntries()
    {
        return $this->hasMany(ScheduleEntry::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Avaiability::class);
    }
}
