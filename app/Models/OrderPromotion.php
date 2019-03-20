<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPromotion extends Model
{
    public $timestamps = false;
    protected $table = "order_promotion";
    protected $fillable = [
        'promotion_id','order_id','date'
    ];

}
