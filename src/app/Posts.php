<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'user_id',
        'p_text',
        'book_id',
        'p_star',
        'created_at',

    ];
}
