<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
