<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;
    protected $table = "bills";
    protected $fillable = [
      'customer_id', 'total', 'description',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function room()
    {
        $this->belongsToMany('App\Models\Room','App\Models\BillRoom');
    }

    public function typeRoom()
    {
        $this->belongsToMany('App\Models\TypeRoom','App\Models\BillTypeRoom');
    }
}
