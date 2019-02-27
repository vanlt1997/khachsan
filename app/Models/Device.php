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

    public function typeRooms()
    {
        return $this->belongsToMany('App\Models\TypeRoom');
    }

}
