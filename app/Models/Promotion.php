<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;
    protected $table = "promotions";
    protected $fillable = [
        'title','sale','description', 'startDate', 'endDate'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($model){
            OrderPromotion::destroy($model->id);
        });
    }
}
