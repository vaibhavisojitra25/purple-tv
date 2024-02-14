<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppBackground extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'background_auto_change',
        'background_mannual_change',
        'back_remote_change',
        'back_orverlay_remote_change',
        'background_orverlay_color_code'
    ];

    public function backgroundUrls()
    {
        return $this->hasMany('App\BackgroundUrl');
    }
}
