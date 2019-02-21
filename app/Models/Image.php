<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    protected $table = "images";
    protected $fillable = [
        'url'
    ];

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function device()
    {
        return $this->belongsToMany('App\Models\Device','App\Models\DeviceImage');
    }

    public function typeRoom()
    {
        return $this->belongsTo('App\Models\TypeRoom');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting( function ($model)
        {
            ImageTypeRoom::where('image_id', $model->id)->delete();
        });
    }

}
