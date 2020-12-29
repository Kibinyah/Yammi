<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    public function latest_visit()
    {
        return $this->hasOne('App\Visit')->latest();
    }
}
