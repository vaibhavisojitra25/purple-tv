<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InAppAnnouncement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'title',
        'short_description',
        'image',
        'status',
        'sent_users',
        'received_users',
        'click_users'
    ];
}
