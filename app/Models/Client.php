<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Get the reservations for the client.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
