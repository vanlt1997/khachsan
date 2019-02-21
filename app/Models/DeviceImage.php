<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceImage extends Model
{
    public $timestamps = false;
    protected $table = "device_image";
    protected $fillable = [
      'device_id', 'image_id'
    ];
}
