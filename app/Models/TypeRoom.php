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
