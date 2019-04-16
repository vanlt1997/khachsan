<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    protected $table = "type_rooms";
    public $timestamps = false;
    protected $fillable = [
        'name','aliases' ,'people', 'bed', 'extra_bed', 'number_room', 'acreage','view','price','sale','description',
    ];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function devices()
    {
        return $this->belongsToMany('App\Models\Device');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }


    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $data = explode(' ', $model->name);
            $model->aliases = implode('-', $data);
        });

        self::deleting(function ($model) {
            ImageTypeRoom::whereTypeRoomId($model->id)->delete();
            DeviceTypeRoom::whereTypeRoomId($model->id)->delete();
        });
    }
}
