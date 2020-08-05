<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // обратная связь один к одному
    public function user() {
        return $this->belongsTo('App\User');
    }

    // полиморфная связь
    public function photos() {
        return $this->MorphMany('App\Photo', 'imageable');
    }

    // полиморфная связь многие к многим
    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

}
