<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Get the service associated with the reservation.
     */
    public function service()
    {
        return $this->hasOne(Service::class);
    }

    /**
     * Get the client associated with the reservation.
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Get the timetable associated with the reservation.
     */
    public function timetable()
    {
        return $this->hasOne(Timetable::class);
    }
}
