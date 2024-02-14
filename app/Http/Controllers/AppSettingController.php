<?php

namespace App\Http\Controllers;

use App\AppAds;
use App\AppSetting;
use App\InAppPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppSettingController extends Controller
{
    public function appSettings(Request $request)
    {
        $settingType = $request->setting_type;
        switch ($settingType) {
            case 'appConfiguration':
                return $this->appConfiguration($request);
                break;
            case 'appUrls':
                return $this->appUrls($request);
                break;
            case 'notificationSettings':
                return $this->notificationSettings($request);
                break;
            case 'generalSetting':
                return $this->generalSetting($request);
                break;
            case 'deviceType':
                return $this->deviceType($request);
                break;
            case 'defaultDevice':
                return $this->defaultDevice($request);
                break;
            case 'tickerSetting':
                return $this->tickerSetting($request);
                break;
            case 'playSetting':
                return $this->playSetting($request);
                break;
            case 'app4kSetting':
                return $this->app4kSetting($request);
                break;
            case 'privateSetting':
                return $this->privateSetting($request);
                break;
            case 'epgSetting':
                return $this->epgSetting($request);
                break;
            case 'appRecording':
                return $this->appRecording($request);
                break;
            case 'cloudSetting':
                return $this->cloudSetting($request);
                break;
            case 'headerSetting':
                return $this->headerSetting($request);
                break;
            case 'emailConfiguration':
                return $this->emailConfiguration($request);
                break;
            case 'channelReporting':
                return $this->channelReporting($request);
                break;
            case 'movieShowRequest':
                return $this->movieShowRequest($request);
                break;
            case 'p2pSetting':
                return $this->p2pSetting($request);
                break;
            case 'themeSetting':
                return $this->themeSetting($request);
                break;
            case 'reportIssueEmail':
                return $this->reportIssueEmail($request);
                break;
            case 'mqttSetting':
                return $this->mqttSetting($request);
                break;
            case 'streamSetting':
                return $this->streamSetting($request);
                break;
            case 'weatherSetting':
                return $this->weatherSetting($request);
                break;
            case 'appSetting':
                return $this->appSetting($request);
                break;
            case 'subUserProfile':
                return $this->subUserProfile($request);
                break;
            case 'inAppPurchaseSetting':
                return $this->inAppPurchaseSetting($request);
                break;
            case 'appAds':
                return $this->appAds($request);
                break;
        }
    }

    function appConfiguration($request)
    {
        $validator = Validator::make($request->all(), [
            'startup_message' => 'required'
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $setting = AppSetting::where('app_id', $request->app_id)->first();
            $setting->startup_message = $request->startup_message;
            $setting->save();
            $response = [
                'success' => true,
                'message' => 'Configuration updated.',
            ];
        }
        return response()->json($response, 200);
    }

    function appUrls($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->domain_url = $request->domain_url;
        $setting->login_url = $request->login_url;
        $setting->chat_url = $request->chat_url;
        $setting->privacy_policy_url = $request->privacy_policy_url;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'URL updated.',
        ];
        return response()->json($response, 200);
    }

    function notificationSettings($request)
    {
        $validator = Validator::make($request->all(), [
            'one_signal_app_id' => 'required',
            'one_signal_rest_key' => 'required',
            'one_signal_google_project_no' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $setting = AppSetting::where('app_id', $request->app_id)->first();
            $setting->one_signal_app_id = $request->one_signal_app_id;
            $setting->one_signal_rest_key = $request->one_signal_rest_key;
            $setting->one_signal_google_project_no = $request->one_signal_google_project_no;
            $setting->save();
            $response = [
                'success' => true,
                'message' => 'Notification Settings updated.',
            ];
        }
        return response()->json($response, 200);
    }

    function generalSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->startup_auto_boot = $request->startup_auto_boot == 'on' ? 1 : 0;
        $setting->setting_option = $request->setting_option == 'on' ? 1 : 0;
        $setting->app_list_status = $request->app_list_status == 'on' ? 1 : 0;
        $setting->private_menu = $request->private_menu == 'on' ? 1 : 0;
        $setting->wifi_option = $request->wifi_option == 'on' ? 1 : 0;
        $setting->is_vpn = $request->is_vpn == 'on' ? 1 : 0;
        $setting->allow_cast = $request->allow_cast == 'on' ? 1 : 0;
        $setting->remote_support = $request->remote_support == 'on' ? 1 : 0;
        $setting->sub_splash = $request->sub_splash == 'on' ? 1 : 0;
        $setting->vpn_sub_splash = $request->vpn_sub_splash == 'on' ? 1 : 0;
        $setting->vpn_login_screen = $request->vpn_login_screen == 'on' ? 1 : 0;
        $setting->clear_catch = $request->clear_catch == 'on' ? 1 : 0;
        $setting->sub_profile = $request->sub_profile == 'on' ? 1 : 0;
        $setting->remind_me = $request->remind_me == 'on' ? 1 : 0;
        $setting->app_external_plugin = $request->app_external_plugin == 'on' ? 1 : 0;
        $setting->startup_plugin_install = $request->startup_plugin_install == 'on' ? 1 : 0;
        $setting->startup_archive_category = $request->startup_archive_category == 'on' ? 1 : 0;
        $setting->intro_video = $request->intro_video == 'on' ? 1 : 0;
        $setting->auto_login = $request->auto_login == 'on' ? 1 : 0;
        $setting->multi_profile = $request->multi_profile == 'on' ? 1 : 0;
        $setting->multi_profile_auto_login = $request->multi_profile_auto_login == 'on' ? 1 : 0;
        $setting->server_selection = $request->server_selection == 'on' ? 1 : 0;
        $setting->is_catchup = $request->is_catchup == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'General setting updated.',
        ];
        return response()->json($response, 200);
    }

    function deviceType($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->startup_device_select = $request->startup_device_select == 'on' ? 1 : 0;
        $setting->manual_device_select = $request->manual_device_select == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Device Type updated.',
        ];
        return response()->json($response, 200);
    }

    function defaultDevice($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->detect_default_device = $request->detect_default_device == 'on' ? 1 : 0;
        $setting->default_device = $request->default_device;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Default device updated.',
        ];
        return response()->json($response, 200);
    }

    function appSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->app_settings = $request->app_settings == 'on' ? 1 : 0;
        $setting->app_settings_passcode = $request->app_settings_passcode;
        $setting->app_general_settings = $request->app_general_settings == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'App settings updated.',
        ];
        return response()->json($response, 200);
    }

    function subUserProfile($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->sub_user_profile = $request->sub_user_profile == 'on' ? 1 : 0;
        $setting->sub_user_profile_allow = $request->sub_user_profile_allow;
        $setting->sub_user_profile_default = $request->sub_user_profile_default == 'on' ? 1 : 0;
        $setting->sub_user_profile_setting = $request->sub_user_profile_setting == 'on' ? 1 : 0;
        $setting->sub_user_profile_select_on_start = $request->sub_user_profile_select_on_start == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Sub user profile updated.',
        ];
        return response()->json($response, 200);
    }

    function inAppPurchaseSetting($request)
    {
        $inAppPurchase = InAppPurchase::where('app_id', $request->app_id)->first();
        $inAppPurchase->in_app_status = $request->in_app_status == 'on' ? 1 : 0;
        $inAppPurchase->in_app_purchase_id = $request->in_app_purchase_id;
        $inAppPurchase->in_app_purchase_license_key = $request->in_app_purchase_license_key;
        $inAppPurchase->save();
        $response = [
            'success' => true,
            'message' => 'In app purchase updated.',
        ];
        return response()->json($response, 200);
    }
    
    function appAds($request)
    {
        $appAds = AppAds::where('app_id', $request->app_id)->first();
        $appAds->ads_app_id = $request->ads_app_id;
        $appAds->ads_banner = $request->ads_banner;
        $appAds->ads_intrestial = $request->ads_intrestial;
        $appAds->ads_rewarded = $request->ads_rewarded;
        $appAds->ads_native = $request->ads_native;
        $appAds->ads_intrestial_time_delay = $request->ads_intrestial_time_delay;
        $appAds->ads_ios_status = $request->ads_ios_status == 'on' ? 1 : 0;
        $appAds->ads_status = $request->ads_status == 'on' ? 1 : 0;
        $appAds->save();
        $response = [
            'success' => true,
            'message' => 'Ads config updated.',
        ];
        return response()->json($response, 200);
    }

    function tickerSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->dashbord_ticker = $request->dashbord_ticker == 'on' ? 1 : 0;
        $setting->login_ticker = $request->login_ticker == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Ticker setting updated.',
        ];
        return response()->json($response, 200);
    }

    function playSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->set_default_play = $request->set_default_play == 'on' ? 1 : 0;
        $setting->set_recent_play = $request->set_recent_play == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Play setting updated.',
        ];
        return response()->json($response, 200);
    }

    function app4kSetting($request)
    {
        $validator = Validator::make($request->all(), [
            'content_4k' => 'required_if:allow_4k,on',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $setting = AppSetting::where('app_id', $request->app_id)->first();
            $setting->allow_4k = $request->allow_4k == 'on' ? 1 : 0;
            $setting->content_4k = $request->content_4k == 'on' ? $request->content_4k : null;
            $setting->save();
            $response = [
                'success' => true,
                'message' => '4k setting updated.',
            ];
        }
        return response()->json($response, 200);
    }

    function privateSetting($request)
    {
        $validator = Validator::make($request->all(), [
            'private_video_url' => 'required_if:private_access,on',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $setting = AppSetting::where('app_id', $request->app_id)->first();
            $setting->private_access = $request->private_access == 'on' ? 1 : 0;
            $setting->private_video_url = $request->private_access == 'on' ? $request->private_video_url : null;
            $setting->save();
            $response = [
                'success' => true,
                'message' => 'Private setting updated.',
            ];
        }
        return response()->json($response, 200);
    }

    function epgSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->epg_timeshift = $request->epg_timeshift == 'on' ? 1 : 0;
        $setting->epg_catchup = $request->epg_catchup == 'on' ? 1 : 0;
        $setting->epg_roku = $request->epg_roku == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'EPG setting updated.',
        ];
        return response()->json($response, 200);
    }

    function appRecording($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->recording = $request->recording == 'on' ? 1 : 0;
        $setting->multi_recording = $request->multi_recording == 'on' ? 1 : 0;
        $setting->cloud_recording = $request->cloud_recording == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Recording setting updated.',
        ];
        return response()->json($response, 200);
    }

    function headerSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->header_key = $request->header_key;
        $setting->header_value = $request->header_value;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Header setting updated.',
        ];
        return response()->json($response, 200);
    }

    function emailConfiguration($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->smtp_server = $request->smtp_server;
        $setting->smtp_port = $request->smtp_port;
        $setting->smtp_username = $request->smtp_username;
        $setting->smtp_password = $request->smtp_password;
        $setting->smtp_from_email = $request->smtp_from_email;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Email setting updated.',
        ];
        return response()->json($response, 200);
    }

    function channelReporting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->channel_reporting = $request->channel_reporting == 'on' ? 1 : 0;
        $setting->channel_reporting_to_email = $request->channel_reporting_to_email;
        $setting->channel_report_email_subject = $request->channel_report_email_subject;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Channel reporting setting updated.',
        ];
        return response()->json($response, 200);
    }

    function movieShowRequest($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->movie_show_reqest = $request->movie_show_reqest == 'on' ? 1 : 0;
        $setting->movie_show_reqest_to_email = $request->movie_show_reqest_to_email;
        $setting->movie_shows_reqest_email_subject = $request->movie_shows_reqest_email_subject;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Movie show request setting updated.',
        ];
        return response()->json($response, 200);
    }

    function p2pSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->p2p = $request->p2p == 'on' ? 1 : 0;
        $setting->p2p_signal = $request->p2p_signal;
        $setting->p2p_setting_default = $request->p2p_setting_default == 'on' ? 1 : 0;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'P2P setting updated.',
        ];
        return response()->json($response, 200);
    }

    function themeSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->theme_change_allow = $request->theme_change_allow == 'on' ? 1 : 0;
        $setting->theme_change_layout = $request->theme_change_layout;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Theme setting updated.',
        ];
        return response()->json($response, 200);
    }

    function reportIssueEmail($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->report_issue = $request->report_issue == 'on' ? 1 : 0;
        $setting->reporting_api = $request->reporting_api;
        $setting->report_issue_from_email = $request->report_issue_from_email;
        $setting->report_issue_to_email = $request->report_issue_to_email;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Report issue email updated.',
        ];
        return response()->json($response, 200);
    }

    function mqttSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->mqtt_server = $request->mqtt_server;
        $setting->mqtt_endpoint = $request->mqtt_endpoint;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'MQTT setting updated.',
        ];
        return response()->json($response, 200);
    }

    function streamSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->stream_format = $request->stream_format;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Stream format updated.',
        ];
        return response()->json($response, 200);
    }

    function weatherSetting($request)
    {
        $setting = AppSetting::where('app_id', $request->app_id)->first();
        $setting->weather_defult_city = $request->weather_defult_city;
        $setting->weather_city = $request->weather_city;
        $setting->weather_city_id = $request->weather_city_id;
        $setting->save();
        $response = [
            'success' => true,
            'message' => 'Weather city updated.',
        ];
        return response()->json($response, 200);
    }

    function cloudSetting($request)
    {
        $validator = Validator::make($request->all(), [
            'cloud_remind_me_url' => 'required_if:cloud_remind_me,on',
            'cloud_recent_fav_url' => 'required_if:cloud_recent_fav,on',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $setting = AppSetting::where('app_id', $request->app_id)->first();
            $setting->cloud_remind_me = $request->cloud_remind_me == 'on' ? 1 : 0;
            $setting->cloud_remind_me_url = $request->cloud_remind_me == 'on' ? $request->cloud_remind_me_url : null;
            $setting->cloud_recent_fav = $request->cloud_recent_fav == 'on' ? 1 : 0;
            $setting->cloud_recent_fav_url = $request->cloud_recent_fav == 'on' ? $request->cloud_recent_fav_url : null;
            $setting->save();
            $response = [
                'success' => true,
                'message' => 'Cloud setting updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
