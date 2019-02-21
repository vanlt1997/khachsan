<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillRoom extends Model
{
    public $timestamps = false;
    protected $table = "bill_room";
    protected $fillable = [
        'room_id','bill_id','check_in','check_out'
    ];
}
