<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppEndPoint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'm3u_parse',
        'login',
        'register',
        'list_get',
        'list_xstream_update',
        'deleteurl',
        'list_m3u_update',
        'epg_endpoint',
    ];
}
