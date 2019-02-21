<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;
    protected $table = "devices";
    protected $fillable = [
      'name','quantity'
    ];

    public function image()
    {
        return $this->belongsToMany('App\Models\Image','App\Models\DeviceImage');
    }

    public function typeRoom()
    {
        return $this->belongsToMany('App\Models\TypeRoom','App\Models\DeviceTypeRoom');
    }
}
