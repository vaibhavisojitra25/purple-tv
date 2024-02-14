<?php

namespace App;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class App extends Model
{
    use SoftDeletes, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'app_code',
        'app_name',
        'package_name',
        'app_type',
        'app_mode',
        'app_mode_universal',
        'app_icon',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->hasOne('App\AppImage');
    }

    public function aboutus()
    {
        return $this->hasOne('App\AppAboutUs');
    }

    public function support()
    {
        return $this->hasOne('App\AppSupport');
    }

    public function vpn()
    {
        return $this->hasOne('App\AppVpn');
    }

    public function version()
    {
        return $this->hasOne('App\AppVersion');
    }

    public function settings()
    {
        return $this->hasOne('App\AppSetting');
    }

    public function endpoint()
    {
        return $this->hasOne('App\AppEndPoint');
    }

    public function apiKey()
    {
        return $this->hasOne('App\AppApiKey');
    }

    public function background()
    {
        return $this->hasOne('App\AppBackground');
    }

    public function language()
    {
        return $this->hasOne('App\AppLanguage');
    }

    public function player()
    {
        return $this->hasOne('App\AppPlayer');
    }

    public function theme()
    {
        return $this->hasOne('App\AppTheme');
    }

    public function private_menu()
    {
        return $this->hasMany('App\AppPrivateMenu');
    }

    public function dns()
    {
        return $this->hasMany('App\DnsUrl');
    }

    public function announcements()
    {
        return $this->hasMany('App\InAppAnnouncement');
    }
    
    public function inAppPurchase()
    {
        return $this->hasOne('App\InAppPurchase');
    }
    
    public function ads()
    {
        return $this->hasOne('App\AppAds');
    }

    public function plugins()
    {
        return Plugin::where('status', 1)->get();
    }
}
