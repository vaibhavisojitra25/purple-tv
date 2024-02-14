<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppAboutUs extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'name',
        'description',
        'developed_by',
        'about_skype_id',
        'about_telegram_no',
        'about_whatsapp_no'
    ];
}
