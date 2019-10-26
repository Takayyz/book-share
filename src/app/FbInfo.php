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
    protected $fillable = ['id', 'fb_thumb', 'fb_name'];
}
