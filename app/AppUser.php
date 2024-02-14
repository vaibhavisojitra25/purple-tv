<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'full_name',
        'email',
        'username',
        'status',
    ];
}
