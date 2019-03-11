<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $table = "services";
    protected $fillable = [
        'name','aliases','price','sale','quantity','description','status','icon'
    ];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model){
            $data = explode(' ', $model->name);
            $model->aliases = implode('-', $data);
        });
    }
}
