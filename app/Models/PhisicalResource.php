<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PhisicalResource extends Model
{
    use HasFactory;

    var $fillable = ['name', 'description', 'weekly_timetable', 'schedule_type', 'schedule_units', 'open', 'service_provider_id']; 
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

    #region accesors
    protected function scheduleUnits(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function weeklyTimetable(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value)
        );
    }
    #endregion

    #region appenders
    public function getServiceProviderNameAttribute(){
        return $this->service_provider->name;
    }
    #endregion
}
