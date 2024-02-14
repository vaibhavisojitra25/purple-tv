<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppAds extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'ads_app_id',
        'ads_banner',
        'ads_intrestial',
        'ads_rewarded',
        'ads_native',
        'ads_intrestial_time_delay',
        'ads_ios_status',
        'ads_status'
    ];
}
