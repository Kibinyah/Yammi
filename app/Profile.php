<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        "realName",
        "dateOfBirth",
        "bio",
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
