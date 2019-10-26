<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbInfo extends Model
{
    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'fb_id', 'fb_avater', 'fb_name'];
}
