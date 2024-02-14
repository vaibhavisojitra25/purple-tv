<?php

namespace App\Http\Controllers;

use App\App;
// use App\AppAboutUs;
// use App\AppAds;
// use App\AppApiKey;
// use App\AppBackground;
// use App\AppEndPoint;
// use App\AppImage;
// use App\AppLanguage;
// use App\AppPlayer;
// use App\AppPrivateMenu;
// use App\AppSetting;
// use App\AppSupport;
// use App\AppTheme;
// use App\AppVersion;
// use App\AppVpn;
// use App\BackgroundUrl;
// use App\InAppPurchase;
use App\CustomVpn;
// use App\DnsUrl;
use App\Http\Resources\AppDetailResource;
use App\Http\Resources\VpnResource;
// use App\InAppAnnouncement;
// use App\User;
use App\Vpn;
// use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function appDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 200);
        } else {
            $app = App::with(['announcements'=>function($query) {
                return $query->latest()->limit(10);
            }])->where('app_code', $request->code)->where('status', 1)->first();
            if ($app) {
                if ($request->has('my') && $request->my == "ok") {
                    return response()->json(new AppDetailResource($app), 200);
                } else {
                    $returnData = new AppDetailResource($app);
                    $returnData = json_encode($returnData->toResponse(null)->getData()->data);
                    for ($i = 0; $i < 4; $i++) {
                        $returnData = base64_encode($returnData);
                    }
                    return $returnData;
                }
            } else {
                return response()->json(['error' => 'App not found'], 200);
            }
        }
    }

    public function gelAllVpn(Request $request)
    {
        if ($request->has('code') && !empty($request->code)) {
            $app = App::where('app_code', $request->code)->first();
            if (!empty($app)) {
                $vpns = CustomVpn::where('user_id', $app->user_id)->where('status', 1)->get();
            } else {
                return response()->json(['error' => 'App not found'], 200);
            }
        } else {
            $vpns = Vpn::where('status', 1)->get();
        }
        return response()->json(["files" => VpnResource::collection($vpns)], 200);
    }

    // public function migrateData()
    // {
    //     $users = DB::select("SELECT * from tbl_users");
    //     foreach ($users as $user) {
    //         $email = ($user->email != 'z') ? $user->email : $user->username . "@gmail.com";
    //         $count = User::where('email', $email)->count();
    //         if ($count == 0) {
    //             $userObj = new User();
    //             $userObj->id = $user->id;
    //             $userObj->full_name = $user->name;
    //             $userObj->email = $email;
    //             $userObj->phone_number = $user->phone;
    //             $userObj->username = $user->username;
    //             $userObj->password = bcrypt($user->username);
    //             $userObj->profile_picture = $user->image;
    //             $userObj->status = $user->status;
    //             $userObj->save();
    //             $userObj->assignRole('User');
    //         }
    //     }

    //     $apps = DB::select("SELECT u.provide_code, u.email, u.username, u.app_type, u.app_name, a.* FROM aio_all_data as a JOIN tbl_users as u ON a.user_id = u.id");
    //     foreach ($apps as $appData) {
    //         $email = ($appData->email != 'z') ? $appData->email : $appData->username . "@gmail.com";
    //         $user = User::where('email', $email)->first();
    //         $app = new App();
    //         $app->app_code = $appData->provide_code;
    //         $app->user_id = $user->id;
    //         $app->app_name = $appData->app_name;
    //         $app->package_name = $appData->package_name;
    //         $app->app_type = 'Android';
    //         $app->app_mode = $appData->app_type;
    //         $app->status = 1;
    //         $app->save();

    //         $appImage = new AppImage();
    //         $appImage->app_id = $app->id;
    //         $appImage->app_remote_image = $appData->app_img;
    //         $appImage->app_wide_logo = $appData->app_logo;
    //         $appImage->app_mobile_icon_image = $appData->app_mobile_icon;
    //         $appImage->tv_banner_image = $appData->app_tv_banner;
    //         $appImage->app_splash_screen = $appData->splash_image;
    //         $appImage->app_background = $appData->back_image;
    //         $appImage->save();

    //         $appVersion = new AppVersion();
    //         $appVersion->app_id = $app->id;
    //         $appVersion->version_check = $appData->version_check;
    //         $appVersion->version_code = $appData->version_code;
    //         $appVersion->version_name = $appData->version_name;
    //         $appVersion->play_store_url = $appData->version_download_url;
    //         $appVersion->apk_url = $appData->version_download_url_apk;
    //         $appVersion->force_update = $appData->version_force_update;
    //         $appVersion->version_update_message = $appData->version_update_msg;
    //         $appVersion->save();

    //         $appAboutUs = new AppAboutUs();
    //         $appAboutUs->app_id = $app->id;
    //         $appAboutUs->description = $appData->a_description;
    //         $appAboutUs->developed_by = $appData->a_developed;
    //         $appAboutUs->name = $appData->a_name;
    //         $appAboutUs->about_skype_id = $appData->a_skype;
    //         $appAboutUs->about_telegram_no = $appData->a_telegram;
    //         $appAboutUs->about_whatsapp_no = $appData->a_whatsapp;
    //         $appAboutUs->save();

    //         $appSupport = new AppSupport();
    //         $appSupport->app_id = $app->id;
    //         $appSupport->support_email = $appData->c_email;
    //         $appSupport->support_website = $appData->c_web;
    //         $appSupport->support_skype_id = $appData->c_skype;
    //         $appSupport->support_telegram_no = $appData->c_telegram;
    //         $appSupport->support_whatsapp_no = $appData->c_whatsapp;
    //         $appSupport->save();

    //         $appSetting = new AppSetting();
    //         $appSetting->app_id = $app->id;
    //         $appSetting->allow_4k = $appData->allow_4k;
    //         $appSetting->content_4k = $appData->content_4k;
    //         $appSetting->domain_url = $appData->domain_url;
    //         $appSetting->login_url = $appData->login_url;
    //         $appSetting->privacy_policy_url = $appData->privacy_policy;
    //         $appSetting->private_access = $appData->private_access;
    //         $appSetting->private_video_url = $appData->private_video_url;
    //         $appSetting->startup_message = $appData->startup_msg;
    //         $appSetting->is_vpn = $appData->vpn;
    //         $appSetting->allow_cast = $appData->allow_cast;
    //         $appSetting->remote_support = $appData->remote_support;
    //         $appSetting->setting_option = $appData->setting_option;
    //         $appSetting->wifi_option = $appData->wifi_option;
    //         $appSetting->sub_splash = $appData->sub_splash;
    //         $appSetting->vpn_sub_splash = $appData->vpn_sub_splash;
    //         $appSetting->vpn_login_screen = $appData->vpn_login_screen;
    //         $appSetting->clear_catch = $appData->clear_catch;
    //         $appSetting->app_list_status = $appData->app_list_status;
    //         $appSetting->private_menu = $appData->private_menu;
    //         $appSetting->epg_timeshift = $appData->epg_timeshift;
    //         $appSetting->epg_catchup = $appData->epg_timeshift;
    //         $appSetting->is_catchup = $appData->catchup;
    //         $appSetting->epg_roku = $appData->epg_roku;
    //         $appSetting->dashbord_ticker = $appData->dashbord_ticker;
    //         $appSetting->login_ticker = $appData->login_ticker;
    //         $appSetting->sub_profile = $appData->sub_profile;
    //         $appSetting->set_default_play = $appData->set_default_play;
    //         $appSetting->set_recent_play = $appData->set_recent_play;
    //         $appSetting->remind_me = $appData->remind_me ?: 0;
    //         $appSetting->cloud_remind_me = $appData->cloud_remind_me ?: 0;
    //         $appSetting->cloud_remind_me_url = $appData->cloud_remind_me_url ?: 0;
    //         $appSetting->cloud_recording = $appData->cloud_recording ?: 0;
    //         $appSetting->cloud_recent_fav = $appData->cloud_recent_fav;
    //         $appSetting->cloud_recent_fav_url = $appData->cloud_recent_fav_url;
    //         $appSetting->multi_recording = $appData->multi_recording ?: 0;
    //         $appSetting->recording = $appData->recording;
    //         $appSetting->app_external_plugin = $appData->app_external_plugin ?: 0;
    //         $appSetting->chat_url = $appData->chat_url;
    //         $appSetting->startup_plugin_install = $appData->startup_plugin_install ?: 0;
    //         $appSetting->startup_archive_category = $appData->startup_archive_category;
    //         $appSetting->header_key = $appData->header_key;
    //         $appSetting->header_value = $appData->header_value;
    //         $appSetting->smtp_server = $appData->smtp_server;
    //         $appSetting->smtp_port = $appData->smtp_port;
    //         $appSetting->smtp_username = $appData->smtp_username;
    //         $appSetting->smtp_password = $appData->smtp_password;
    //         $appSetting->smtp_from_email = $appData->smtp_from_email;
    //         $appSetting->channel_reporting = $appData->channel_reporting;
    //         $appSetting->channel_reporting_to_email = $appData->channel_reporting_to_email;
    //         $appSetting->movie_show_reqest = $appData->movie_show_reqest;
    //         $appSetting->movie_show_reqest_to_email = $appData->movie_show_reqest_to_email;
    //         $appSetting->channel_report_email_subject = $appData->channel_report_email_subject;
    //         $appSetting->movie_shows_reqest_email_subject = $appData->movie_shows_reqest_email_subject;
    //         $appSetting->p2p = $appData->p2p;
    //         $appSetting->p2p_signal = $appData->p2p_signal;
    //         $appSetting->p2p_setting_default = $appData->p2p_setting_default;
    //         $appSetting->intro_video = $appData->intro_video;
    //         $appSetting->theme_change_allow = $appData->theme_change_allow;
    //         $appSetting->theme_change_layout = $appData->theme_change_layout;
    //         $appSetting->report_issue = $appData->report_issue;
    //         $appSetting->reporting_api = '#';
    //         $appSetting->report_issue_from_email = $appData->report_issue_from_email;
    //         $appSetting->report_issue_to_email = $appData->report_issue_to_email;
    //         $appSetting->mqtt_server = $appData->mqtt_server;
    //         $appSetting->mqtt_endpoint = $appData->mqtt_endpoint;
    //         $appSetting->auto_login = $appData->auto_login;
    //         $appSetting->multi_profile = $appData->multi_profile;
    //         $appSetting->server_selection = $appData->server_selection;
    //         $appSetting->app_settings = $appData->app_settings;
    //         $appSetting->app_settings_passcode = $appData->app_settings_passcode;
    //         $appSetting->app_general_settings = $appData->app_general_settings;
    //         $appSetting->multi_profile_auto_login = $appData->multi_profile_auto_login;
    //         $appSetting->sub_user_profile = $appData->sub_user_profile;
    //         $appSetting->sub_user_profile_allow = $appData->sub_user_profile_allow;
    //         $appSetting->sub_user_profile_default = $appData->sub_user_profile_default;
    //         $appSetting->sub_user_profile_setting = $appData->sub_user_profile_setting;
    //         $appSetting->sub_user_profile_select_on_start = $appData->sub_user_profile_select_on_start;
    //         $appSetting->stream_format = $appData->stream_format;
    //         $appSetting->startup_auto_boot = $appData->startup_auto_boot;
    //         $appSetting->startup_device_select = $appData->startup_device_select;
    //         $appSetting->manual_device_select = $appData->manual_device_select;
    //         $appSetting->detect_default_device = $appData->default_device_select_detect;
    //         $appSetting->default_device = $appData->default_device_select_device;
    //         $appSetting->save();

    //         $appEndPoint = new AppEndPoint();
    //         $appEndPoint->app_id = $app->id;
    //         $appEndPoint->m3u_parse = $appData->m3u_parse;
    //         $appEndPoint->login = $appData->login;
    //         $appEndPoint->register = $appData->register;
    //         $appEndPoint->list_get = $appData->list_get;
    //         $appEndPoint->list_xstream_update = $appData->list_xstream_update;
    //         $appEndPoint->deleteurl = $appData->deleteurl;
    //         $appEndPoint->list_m3u_update = $appData->list_update_epg;
    //         $appEndPoint->epg_endpoint = $appData->epg_endpoint;
    //         $appEndPoint->save();

    //         $appApiKey = new AppApiKey();
    //         $appApiKey->app_id = $app->id;
    //         $appApiKey->imdb_api = $appData->imdb_api;
    //         $appApiKey->g_api_key = $appData->g_api_key;
    //         $appApiKey->image_imdb = $appData->image_imdb;
    //         $appApiKey->trakt_api_key = $appData->trakt_api_key;
    //         $appApiKey->ip_stack_key = $appData->ip_stack_key;
    //         $appApiKey->check_ip = $appData->check_ip;
    //         $appApiKey->save();

    //         $appBackground = new AppBackground();
    //         $appBackground->app_id = $app->id;
    //         $appBackground->background_auto_change = $appData->background_auto_change;
    //         $appBackground->background_mannual_change = $appData->background_mannual_change;
    //         $appBackground->background_orverlay_color_code = $appData->background_orverlay_color_code;
    //         $appBackground->save();

    //         $appLanguage = new AppLanguage();
    //         $appLanguage->app_id = $app->id;
    //         $appLanguage->defult_language = $appData->defult_language;
    //         $appLanguage->firstime_select_language = $appData->firstime_select_language;
    //         $appLanguage->save();

    //         $appTheme = new AppTheme();
    //         $appTheme->app_id = $app->id;
    //         $appTheme->theme_defult_layout = $appData->theme_defult_layout;
    //         $appTheme->theme_color_1 = $appData->theme_color_1;
    //         $appTheme->theme_color_2 = $appData->theme_color_2;
    //         $appTheme->theme_color_3 = $appData->theme_color_3;
    //         $appTheme->roku_color_primary = $appData->roku_color_primary;
    //         $appTheme->roku_color_secondary = $appData->roku_color_secondary;
    //         $appTheme->roku_button_focus = $appData->roku_button_focus;
    //         $appTheme->roku_button_unfocus = $appData->roku_button_unfocus;
    //         $appTheme->theme_change = $appData->theme_change;
    //         $appTheme->roku_background_overlay = $appData->roku_background_overlay;
    //         $appTheme->save();

    //         $appPlayer = new AppPlayer();
    //         $appPlayer->app_id = $app->id;
    //         $appPlayer->save();

    //         $inAppPurchase = new InAppPurchase();
    //         $inAppPurchase->app_id = $app->id;
    //         $inAppPurchase->in_app_purchase_id = $appData->in_app_purchase_id;
    //         $inAppPurchase->in_app_purchase_license_key = $appData->lic_key;
    //         $inAppPurchase->in_app_status = $appData->in_app_status;
    //         $inAppPurchase->save();

    //         $appAds = new AppAds();
    //         $appAds->app_id = $app->id;
    //         $appAds->ads_app_id = $appData->ads_app_id;
    //         $appAds->ads_banner = $appData->ads_banner;
    //         $appAds->ads_intrestial = $appData->ads_intrestial;
    //         $appAds->ads_rewarded = $appData->ads_rewarded;
    //         $appAds->ads_native = $appData->ads_native;
    //         $appAds->ads_ios_status = $appData->ads_ios_status;
    //         $appAds->ads_status = $appData->ads_status;
    //         $appAds->save();

    //         $appVpn = new AppVpn();
    //         $appVpn->app_id = $app->id;
    //         $appVpn->vpn_mode = 'system';
    //         $appVpn->save();

    //         $permissions = ["Send Push Notification", "Update Push Notification Settings", "View In-App Announcement", "Create In-App Announcement", "Edit In-App Announcement", "Delete In-App Announcement", "View DNS", "Create DNS", "Edit DNS", "Delete DNS", "View Private Menu", "Create Private Menu", "Edit Private Menu", "Delete Private Menu", "View App Images", "Update App Wide Logo", "Update TV Banner Image", "Update Mobile Icon Image", "Update Background Image", "Update Splash Screen Image", "View App Version", "View App Player", "View About Us", "Update About Us", "View Support", "Update Support", "View VPN Config", "View Theme", "View Background", "Manage App Setting", "View App Configuration", "View Language", "View URL", "View General Setting", "View App Settings", "View Theme Settings", "View Sub User Profile", "View Device Type", "View Ticker Setting", "View Play Setting", "View Default Device", "View In-App Purchase", "View Channel Reporting", "View Movie Show Request", "View Report Issue Email", "View MQTT Setting", "View Header Setting", "View SMTP Setting", "Update SMTP Setting", "View Weather Setting", "View EPG Setting", "View Recording Setting", "View Cloud Setting", "View P2P Setting", "View Stream Setting"];
    //         $app->syncPermissions($permissions);
    //     }

    //     $announcements = DB::select("SELECT u.provide_code, a.* FROM aio_app_announcement as a JOIN tbl_users as u ON a.user_id = u.id");
    //     $otherCodes = [];
    //     foreach ($announcements as $announcement) {
    //         $app = App::where('app_code', $announcement->provide_code)->first();
    //         if ($app) {
    //             $announcementObj = new InAppAnnouncement();
    //             $announcementObj->app_id = $app->id;
    //             $announcementObj->title = $announcement->title;
    //             $announcementObj->short_description = $announcement->short_description;
    //             $announcementObj->image = $announcement->image;
    //             $announcementObj->status = $announcement->status;
    //             $announcementObj->save();
    //         } else {
    //             $otherCodes[] =  ['code' => $announcement->provide_code, 'user_id' => $announcement->user_id];
    //         }
    //     }

    //     $allDns = DB::select("SELECT u.provide_code, d.* FROM aio_app_dns as d JOIN tbl_users as u ON d.user_id = u.id");
    //     foreach ($allDns as $dns) {
    //         $app = App::where('app_code', $dns->provide_code)->first();
    //         $dnsObj = new DnsUrl();
    //         $dnsObj->app_id = $app->id;
    //         $dnsObj->dns_title = $dns->dns_name ?: '';
    //         $dnsObj->url = $dns->url;
    //         $dnsObj->live_dns = $dns->live_dns;
    //         $dnsObj->epg_dns = $dns->epg_dns;
    //         $dnsObj->movie_dns = $dns->movie_dns;
    //         $dnsObj->series_dns = $dns->series_dns;
    //         $dnsObj->catchup_dns = $dns->catchup_dns;
    //         $dnsObj->save();
    //     }

    //     $allMenu = DB::select("SELECT u.provide_code, m.* FROM aio_app_menu as m JOIN tbl_users as u ON m.user_id = u.id");
    //     foreach ($allMenu as $menu) {
    //         $app = App::where('app_code', $menu->provide_code)->first();
    //         $menuObj = new AppPrivateMenu();
    //         $menuObj->app_id = $app->id;
    //         $menuObj->addtion_app_icon = $menu->addtion_app_icon;
    //         $menuObj->addtion_app_name = $menu->addtion_app_name;
    //         $menuObj->addtion_app_pkg = $menu->addtion_app_pkg;
    //         $menuObj->addtion_app_url = $menu->addtion_app_url;
    //         $menuObj->addtion_app_status = $menu->addtion_app_status;
    //         $menuObj->save();
    //     }

    //     $urls = DB::select("SELECT u.provide_code, b.* FROM aio_home_banner as b JOIN tbl_users as u ON b.user_id = u.id");
    //     foreach ($urls as $url) {
    //         $app = App::where('app_code', $url->provide_code)->first();
    //         $urlObj = new BackgroundUrl();
    //         $urlObj->app_background_id = $app->background->id;
    //         $urlObj->url = $url->banner_image;
    //         $urlObj->save();
    //     }
    // }

    // public function migrateAnnouncement()
    // {
    //     $announcements = DB::select("SELECT u.provide_code, a.* FROM aio_app_announcement as a JOIN tbl_users as u ON a.user_id = u.id");
    //     $otherCodes = [];
    //     foreach ($announcements as $announcement) {
    //         $app = App::where('app_code', $announcement->provide_code)->first();
    //         if ($app) {
    //             $announcementObj = new InAppAnnouncement();
    //             $announcementObj->app_id = $app->id;
    //             $announcementObj->title = $announcement->title;
    //             $announcementObj->short_description = $announcement->short_description;
    //             $announcementObj->image = $announcement->image;
    //             $announcementObj->status = $announcement->status;
    //             $announcementObj->save();
    //         } else {
    //             $otherCodes[] =  ['code' => $announcement->provide_code, 'user_id' => $announcement->user_id];
    //         }
    //     }
    //     return response()->json($otherCodes);
    // }

    // public function migrateDns()
    // {
    //     $allDns = DB::select("SELECT u.provide_code, d.* FROM aio_app_dns as d JOIN tbl_users as u ON d.user_id = u.id");
    //     foreach ($allDns as $dns) {
    //         $app = App::where('app_code', $dns->provide_code)->first();
    //         $dnsObj = new DnsUrl();
    //         $dnsObj->app_id = $app->id;
    //         $dnsObj->dns_title = $dns->dns_name ?: '';
    //         $dnsObj->url = $dns->url;
    //         $dnsObj->live_dns = $dns->live_dns;
    //         $dnsObj->epg_dns = $dns->epg_dns;
    //         $dnsObj->movie_dns = $dns->movie_dns;
    //         $dnsObj->series_dns = $dns->series_dns;
    //         $dnsObj->catchup_dns = $dns->catchup_dns;
    //         $dnsObj->save();
    //     }
    // }

    // public function migrateMenu()
    // {
    //     $allMenu = DB::select("SELECT u.provide_code, m.* FROM aio_app_menu as m JOIN tbl_users as u ON m.user_id = u.id");
    //     foreach ($allMenu as $menu) {
    //         $app = App::where('app_code', $menu->provide_code)->first();
    //         $menuObj = new AppPrivateMenu();
    //         $menuObj->app_id = $app->id;
    //         $menuObj->addtion_app_icon = $menu->addtion_app_icon;
    //         $menuObj->addtion_app_name = $menu->addtion_app_name;
    //         $menuObj->addtion_app_pkg = $menu->addtion_app_pkg;
    //         $menuObj->addtion_app_url = $menu->addtion_app_url;
    //         $menuObj->addtion_app_status = $menu->addtion_app_status;
    //         $menuObj->save();
    //     }
    // }

    // public function migrateBackgroudUrl()
    // {
    //     $urls = DB::select("SELECT u.provide_code, b.* FROM aio_home_banner as b JOIN tbl_users as u ON b.user_id = u.id");
    //     foreach ($urls as $url) {
    //         $app = App::where('app_code', $url->provide_code)->first();
    //         $urlObj = new BackgroundUrl();
    //         $urlObj->app_background_id = $app->background->id;
    //         $urlObj->url = $url->banner_image;
    //         $urlObj->save();
    //     }
    // }
}
