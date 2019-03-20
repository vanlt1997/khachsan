<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = "orders";
    protected $fillable = [
      'customer_id', 'type_room_id', 'status_order_id', 'quantity', 'price', 'sale', 'total', 'payment_method', 'start_date', 'end_date'
    ];

    public function promotions()
    {
        return $this->belongsToMany('App\Models\Promotion');
    }
}
