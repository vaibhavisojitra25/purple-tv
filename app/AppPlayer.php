<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppPlayer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'live_tv',
        'vod',
        'series',
        'catch_up'
    ];
}
