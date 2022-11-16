<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhisicalResource extends Model
{
    use HasFactory;

    var $hidden = ['created_at', 'updated_at', 'service_provider_id', 'service_provider'];
    var $appends = ['service_provider_name'];

    /**
     * Get the reservations of the phisical resource.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function getServiceProviderNameAttribute(){
        return $this->service_provider->name;
    }
}
