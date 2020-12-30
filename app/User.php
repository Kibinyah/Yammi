<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Post;
use App\Comment;

class User extends Authenticatable
{
    protected $fillable = [
        "username",
        "email",
        "password",
        "profile_image",
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
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name',$roles)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function ownsProfile($user)
    {
        if($this->profile()->where('user_id',$user)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function ownsPost($user)
    {
        if($this->posts()->where('user_id',$user)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function ownsComment($user)
    {
        if($this->comments()->where('user_id',$user)->first()){
            return true;
        }else{
            return false;
        }
    }
}
