<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceTypeRoom extends Model
{
    public $timestamps = false;
    protected $table = "device_type_room";
    protected $fillable = [
        'device_id', 'type_room_id'
    ];
}
