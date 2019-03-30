<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = "orders";
    protected $fillable = [
      'user_id', 'type_room_id', 'status_order_id','payment_id', 'quantity', 'price', 'sale', 'total', 'start_date', 'end_date'
    ];

    public function promotions()
    {
        return $this->belongsToMany('App\Models\Promotion');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
