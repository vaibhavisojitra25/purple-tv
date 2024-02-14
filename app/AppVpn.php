<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppVpn extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vpn_mode',
        'vpn_username',
        'vpn_password'
    ];
}
