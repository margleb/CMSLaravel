<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // полиморфная связь
    public function imageable() {
        return $this->morphTo();
    }
}
