<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppTheme extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'theme_defult_layout',
        'theme_color_1',
        'theme_color_2',
        'theme_color_3',
        'roku_color_primary',
        'roku_color_secondary',
        'roku_button_focus',
        'roku_button_unfocus',
        'theme_change'
    ];
}
