<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $table = "rooms";
    protected $fillable = [
        'type_room_id','status_id','name','description'
    ];

    public function typeRoom()
    {
        return $this->belongsTo('App\Models\TypeRoom');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function orderTypeRooms()
    {
        return $this->belongsToMany('App\Models\OrderTypeRoom');
    }
}
