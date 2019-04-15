<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTypeRoom extends Model
{
    public $timestamps = false;
    protected $table = "order_type_room";
    protected $fillable = [
        'order_id', 'type_room_id', 'number_people', 'number_room', 'price', 'sale', 'total', 'start_date', 'end_date'
    ];
}
