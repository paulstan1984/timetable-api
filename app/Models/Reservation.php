<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Get the resource of the reservation.
     */
    public function phisical_resource()
    {
        return $this->hasOne(PhisicalResource::class);
    }
}
