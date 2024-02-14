<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppVersion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'version_check',
        'version_update_message',
        'version_code',
        'version_name',
        'play_store_url',
        'apk_url',
        'force_update'
    ];
}
