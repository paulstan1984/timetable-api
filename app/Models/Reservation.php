<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    var $hidden = ['created_at', 'updated_at', 'phisical_resource_id'];

    public function phisical_resource()
    {
        return $this->belongsTo(PhisicalResource::class);
    }
}
