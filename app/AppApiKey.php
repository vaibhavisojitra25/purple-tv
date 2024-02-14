<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppApiKey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'imdb_api',
        'g_api_key',
        'image_imdb',
        'weather_api',
        'trakt_api_key',
        'ip_stack_key',
        'check_ip'
    ];
}
