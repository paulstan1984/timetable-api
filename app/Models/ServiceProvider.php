<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    /**
     * Get the phisical resources for the service provider.
     */
    public function phisical_resources()
    {
        return $this->hasMany(PhisicalResource::class);
    }

    /**
     * Get the timetables for the service provider.
     */
    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
