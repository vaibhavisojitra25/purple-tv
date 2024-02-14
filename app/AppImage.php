<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'app_wide_logo',
        'tv_banner_image',
        'app_mobile_icon_image',
        'app_background',
        'app_splash_screen',
        'app_remote_image'
    ];
}
