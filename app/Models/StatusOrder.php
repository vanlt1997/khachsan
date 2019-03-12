<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{

    public $timestamps = false;
    protected $table = 'status_order';

    protected $fillable = [
        'name'
    ];

}
