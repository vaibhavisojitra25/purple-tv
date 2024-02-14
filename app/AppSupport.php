<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSupport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'support_email',
        'support_website',
        'support_skype_id',
        'support_telegram_no',
        'support_whatsapp_no'
    ];
}
