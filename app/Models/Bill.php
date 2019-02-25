<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;
    protected $table = "bills";
    protected $fillable = [
      'customer_id', 'total', 'description',
    ];

}
