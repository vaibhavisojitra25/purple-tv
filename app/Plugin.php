<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plugin extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'version',
        'playstore_url',
        'apk_url',
        'status',
        'pkg_name'
    ];
}
