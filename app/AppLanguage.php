<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppLanguage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'defult_language',
        'firstime_select_language'
    ];
}
