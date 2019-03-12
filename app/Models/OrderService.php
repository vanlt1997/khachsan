<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    public $timestamps = false;
    protected $table = "order_service";
    protected $fillable = [
        'order_detail_id', 'service_id', 'date', 'price', 'sale', 'quantity', 'total', 'description'
    ];
}
