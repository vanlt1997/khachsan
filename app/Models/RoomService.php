<?php

namespace App\Models;


class RoomService
{
    public $timestamps = false;
    protected $table = "room_service";
    protected $fillable = [
        'room_id','service_id','quantity'
    ];

}
