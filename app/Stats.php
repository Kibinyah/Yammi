<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    //
    public function statable()
    {
        return $this->morphTo();
    }

    
}
