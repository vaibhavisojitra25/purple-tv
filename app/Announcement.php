<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_description',
        'image',
        'status',
        'sent_users',
        'received_users',
        'click_users'
    ];
}
