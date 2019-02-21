<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeRoomService extends Model
{
    public $timestamps = false;
    protected $table = "type_room_service";
    protected $fillable = [
        'customer_id', 'total', 'description',
    ];
}
