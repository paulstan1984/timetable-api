<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    /**
     * Get the open days for the timetable.
     */
    public function open_days()
    {
        return $this->hasMany(OpenDay::class);
    }

    
    /**
     * Get the reservations for the timetable.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
