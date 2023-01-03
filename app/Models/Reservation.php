<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    var $fillable = ['client_name', 'client_phone', 'client_email', 'start_time', 'schedule_unit', 'phisical_resource_id']; 
    var $hidden = ['created_at', 'updated_at'];
    var $appends = ['phisical_resource_name'];

    public function phisical_resource()
    {
        return $this->belongsTo(PhisicalResource::class);
    }

    #region appenders
    public function getPhisicalResourceNameAttribute(){
        return $this->phisical_resource->name;
    }
    #endregion
}
