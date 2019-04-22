<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $table = "order_detail";
    protected $fillable = [
        'order_type_room_id', 'room_id', 'date', 'start_date', 'end_date', 'description'
    ];

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function orderTypeRoom()
    {
        return $this->belongsTo('App\Models\OrderTypeRoom');
    }
}
