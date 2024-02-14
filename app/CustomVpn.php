<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomVpn extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country',
        'city',
        'file_url',
        'status'
    ];
}
