<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppPrivateMenu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'addtion_app_icon',
        'addtion_app_name',
        'addtion_app_pkg',
        'addtion_app_url',
        'addtion_app_status'
    ];
}
