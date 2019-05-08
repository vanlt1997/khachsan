<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageService extends Model
{
    public $timestamps = false;
    protected $table = 'image_service';
    protected $fillable = [
        'image_id', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function images()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
