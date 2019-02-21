<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $table = "services";
    protected $fillable = [
        'name','aliases','description','status','icon'
    ];

    public function detailService()
    {
        return $this->hasMany('App\Models\Detail_Service');
    }

    public function image()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function typeRoom()
    {
        return $this->belongsToMany('App\Models\TypeRoom','App\Models\TypeRoomService');
    }
}
