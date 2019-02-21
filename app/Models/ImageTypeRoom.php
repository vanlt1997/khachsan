<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageTypeRoom extends Model
{
    public $timestamps = false;
    protected $table = "image_type_room";
    protected $fillable = [
        'image_id','type_room_id'
    ];
}
