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

    public function image()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function service()
    {
        return $this->belongsToMany('App\Models\Service','App\Models\TypeRoomService');
    }

    public function device()
    {
        return $this->belongsToMany('App\Models\Device','App\Models\DeviceTypeRoom');
    }

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function bill()
    {
        return $this->belongsToMany('App\Models\Bill','App\Models\BillTypeRoom');
    }

    public static function boot()
    {
        parent::boot();

        self::saving( function ($model)
        {
            $data = explode(' ', $model->name);
            $model->aliases = implode('-', $data);
        });

        self::deleting( function ($model)
        {
            ImageTypeRoom::whereTypeRoomId($model->id)->delete();
        });
    }
}
