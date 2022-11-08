<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhisicalResource extends Model
{
    use HasFactory;

    /**
     * Get the reservations of the phisical resource.
     */
    public function reservations()
    {
        return $this->hasOne(Reservation::class);
    }
}
