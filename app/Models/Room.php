<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $table = "rooms";
    protected $fillable = [
        'type_room_id','status_id','name','description'
    ];

    public function typeRoom()
    {
        return $this->belongsTo('App\Models\TypeRoom');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function bill()
    {
        return $this->belongsToMany('App\Models\Bill', 'App\Models\BillRoom');
    }
}
