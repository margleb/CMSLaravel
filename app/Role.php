<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // связь многие к многим
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
