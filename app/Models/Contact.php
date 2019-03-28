<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $table = "contacts";
    protected $fillable = [
        'name','email','title','content'
    ];
}
