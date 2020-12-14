<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        "username",
        "email",
        "password",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];
    //
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}
