<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DnsUrl extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'dns_title',
        'url',
        'live_dns',
        'epg_dns',
        'movie_dns',
        'series_dns',
        'catchup_dns'
    ];
}
