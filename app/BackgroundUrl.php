<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BackgroundUrl extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_background_id',
        'url'
    ];

    public function appBackground()
    {
        return $this->belongsTo('App\AppBackground');
    }
}
