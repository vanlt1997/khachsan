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

    public function typeRoom()
    {
        return $this->belongsTo('App\Models\TypeRoom');
    }

    public function images()
    {
        return $this->belongsTo('App\Models\Image');
    }

}
