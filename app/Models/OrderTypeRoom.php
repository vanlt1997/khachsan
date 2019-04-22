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

    public function rooms()
    {
        return $this->belongsToMany('App\Models\Room');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function typeRoom()
    {
        return $this->belongsTo('App\Models\TypeRoom');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public static function boot()
    {
        parent::boot();
    }
}
