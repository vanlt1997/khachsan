<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $table = 'services';
    protected $fillable = [
        'name','aliases','description','icon'
    ];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            $data = explode(' ', $model->name);
            $model->aliases = implode('-', $data);
        });
        self::deleting(function ($model) {
            ImageService::whereServiceId($model->id)->delete();
        });
    }
}
