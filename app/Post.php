<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commenter;

class Post extends Model
{
    //
    protected $guarded = [];

    protected $fillable = [
        "title",
        "content",
        "cover_image",
    ];
    
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

    public function stats(){
        return $this->morphOne('App\Stats','statable');
    }
}
