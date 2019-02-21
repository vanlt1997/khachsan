<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillTypeRoom extends Model
{
    public $timestamps = false;
    protected $table = "bill_type_room";
    protected $fillable = [
      'device_id','type_room_id','check_in','check_out'
    ];
}
