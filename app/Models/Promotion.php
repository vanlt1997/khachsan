<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;
    protected $table = "promotions";
    protected $fillable = [
        'title','sale','description'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
