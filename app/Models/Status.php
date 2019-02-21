<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    public $timestamps = false;
    protected $table = 'status';

    protected $fillable = [
        'name'
    ];

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }
}
