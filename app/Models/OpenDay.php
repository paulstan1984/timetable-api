<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenDay extends Model
{
    use HasFactory;

    /**
     * Get the open times for the open day.
     */
    public function open_times()
    {
        return $this->hasMany(OpenDay::class);
    }
}
