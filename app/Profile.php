<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        "realName",
        "dateOfBirth",
        "bio",
        'profile_image'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
