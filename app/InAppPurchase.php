<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InAppPurchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'in_app_status',
        'in_app_purchase_id',
        'in_app_purchase_license_key'
    ];
}
