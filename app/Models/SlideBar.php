<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideBar extends Model
{
    public $timestamps = false;
    protected $table = 'slidebars';

    protected $fillable = [
      'url' , 'description',
    ];
}
