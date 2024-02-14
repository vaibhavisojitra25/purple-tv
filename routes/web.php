<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Route group for Backend prefixed with "admin".
| To Enable Authentication just remove the comment from Admin Middleware
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::impersonate();

    Route::get('/dashboard', [
        'as' => 'dashboard', 'uses' => 'DashboardController@index'
    ])->middleware(['permission:View Dashboard']);

    Route::group(['middleware' => ['permission:Manage Profile']], function () {
        Route::get('profile', 'UserController@getProfile')->name('viewProfile');
        Route::post('profile/{id}/edit', 'UserController@updateProfile')->name('updateProfile');
        Route::delete('deleteaccount', 'UserController@deleteAccount')->name('deleteAccount');
    });

    Route::resource('inappannouncement', 'InAppAnnouncementController');
    Route::resource('dnsurl', 'DnsUrlController');
    Route::resource('appmenu', 'AppPrivateMenuController');

    Route::post('appimage', 'AppImageController@store')->name('appimage.store');
    Route::post('appversion', 'AppVersionController@store')->name('appversion.store');
    Route::post('player', 'AppPlayerController@store')->name('player.store');
    Route::get('appuser', 'AppUserController@index')->name('appuser.index');
    Route::post('appsettings', 'AppSettingController@appSettings')->name('app.settings');
    Route::post('aboutUs', 'AppAboutUsController@store')->name('aboutUs.store');
    Route::post('supportTeam', 'AppSupportController@store')->name('supportTeam.store');
    Route::post('endpoint', 'AppEndPointController@store')->name('endpoint.store');
    Route::post('apikey', 'AppApiKeyController@store')->name('apiKey.store');
    Route::post('vpn', 'AppVpnController@store')->name('vpn.store');
    Route::post('background', 'AppBackgroundController@store')->name('background.store');
    Route::post('language', 'AppLanguageController@store')->name('applanguage.store');
    Route::post('theme', 'AppThemeController@store')->name('theme.store');

    Route::group(['middleware' => ['role:SuperAdmin|Support']], function () {
        Route::get('apppermissions/{id}', 'AppController@showAppPermissions')->name('apppermissions.show');
        Route::put('apppermissions/{id}', 'AppController@updateAppPermissions')->name('apppermissions.update');
    });

    Route::group(['middleware' => ['permission:View Notification|Add Notification|Delete Notification']], function () {
        Route::resource('notification', 'NotificationController');
    });

    Route::group(['middleware' => ['permission:View Announcement|Add Announcement|Delete Announcement']], function () {
        Route::resource('announcement', 'AnnouncementController');
    });
    Route::post('changeannouncementstatus', 'AnnouncementController@changeAnnouncementStatus')->name('changeAnnouncementStatus');

    Route::group(['middleware' => ['permission:View Users|Create Users|Edit Users|Delete Users']], function () {
        Route::resource('users', 'UserController');
    });

    Route::post('changeuserstatus', 'UserController@changeUserStatus')->name('changeUserStatus');

    Route::group(['middleware' => ['permission:View Plugin|Create Plugin|Edit Plugin|Delete Plugin']], function () {
        Route::resource('plugins', 'PluginController');
    });

    Route::post('changepluginstatus', 'PluginController@changePluginStatus')->name('changePluginStatus')->middleware(['permission:Edit Plugin']);

    Route::group(['middleware' => ['permission:View VPN|Create VPN|Edit VPN|Delete VPN']], function () {
        Route::resource('vpns', 'VpnController');
    });

    Route::post('changevpnstatus', 'VpnController@changeVpnStatus')->name('changeVpnStatus')->middleware(['permission:Edit VPN']);

    Route::group(['middleware' => ['permission:View Role|Create Role|Edit Role|Delete Role']], function () {
        Route::resource('roles', 'RoleController');
    });

    Route::group(['middleware' => ['permission:View App|Create App|Edit App|Delete App|Manage App']], function () {
        Route::resource('apps', 'AppController');
        Route::post('resetapp', 'AppController@resetApp')->name('resetApp');
    });
    Route::post('acceptrejectapp', 'AppController@acceptRejectApp')->name('acceptRejectApp');
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Guest routes cannot be accessed if the user is already logged in.
| He will be redirected to '/" if he's logged in.
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('login', [
        'as' => 'login', 'uses' => 'AuthController@login'
    ]);

    Route::get('register', [
        'as' => 'register', 'uses' => 'AuthController@register'
    ]);

    Route::post('login', [
        'as' => 'login.post', 'uses' => 'AuthController@postLogin'
    ]);

    Route::get('forgot-password', [
        'as' => 'forgot-password.index', 'uses' => 'ForgotPasswordController@getEmail'
    ]);

    Route::post('/forgot-password', [
        'as' => 'send-reset-link', 'uses' => 'ForgotPasswordController@postEmail'
    ]);

    Route::get('/password/reset/{token}', [
        'as' => 'password.reset', 'uses' => 'ForgotPasswordController@GetReset'
    ]);

    Route::post('/password/reset', [
        'as' => 'reset.password.post', 'uses' => 'ForgotPasswordController@postReset'
    ]);

    Route::get('auth/{provider}', 'AuthController@redirectToProvider');

    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
});

Route::get('logout', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);
