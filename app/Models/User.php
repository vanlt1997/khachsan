<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password','sex','phone','address','account','avatar', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    protected static function boot()
    {
        parent::boot();
        self::deleted(function ($model) {
            RoleUser::whereUserId($model->id)->delete();
        });
    }

}
