<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;
    protected $table = "devices";
    protected $fillable = [
      'image_id','name','quantity'
    ];

}
