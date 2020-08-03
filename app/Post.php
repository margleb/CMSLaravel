<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes; // "мягкое" удаление
    // Предотвращение ошибки MassAssignmentException
    protected $fillable = ['title', 'content'];
    protected $dates = ['deleted_at']; // дата "мягкого" удаления
}
