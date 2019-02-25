<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    public $timestamps = false;
    protected $table = "detail_service";
    protected $fillable = [
        'service_id','name','price','sale','description'
    ];

}
