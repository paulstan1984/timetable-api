<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Get the phisical resource associated with the service.
     */
    public function phisical_resource()
    {
        return $this->hasOne(PhisicalResource::class);
    }
}
