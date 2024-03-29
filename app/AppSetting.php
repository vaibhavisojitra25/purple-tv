<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'app_id',
        'allow_4k',
        'content_4k',
        'domain_url',
        'login_url',
        'privacy_policy_url',
        'private_access',
        'private_video_url',
        'startup_message',
        'is_vpn',
        'allow_cast',
        'remote_support',
        'setting_option',
        'wifi_option',
        'sub_splash',
        'vpn_sub_splash',
        'vpn_login_screen',
        'clear_catch',
        'app_list_status',
        'private_menu',
        'epg_timeshift',
        'epg_catchup',
        'epg_roku',
        'dashbord_ticker',
        'login_ticker',
        'sub_profile',
        'set_default_play',
        'set_recent_play',
        'remind_me',
        'cloud_remind_me',
        'cloud_remind_me_url',
        'cloud_recording',
        'cloud_recent_fav',
        'cloud_recent_fav_url',
        'multi_recording',
        'recording',
        'app_external_plugin',
        'chat_url',
        'startup_plugin_install',
        'startup_archive_category',
        'header_key',
        'header_value',
        'smtp_server',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_from_email',
        'channel_reporting',
        'channel_reporting_to_email',
        'movie_show_reqest',
        'movie_show_reqest_to_email',
        'channel_report_email_subject',
        'movie_shows_reqest_email_subject',
        'p2p',
        'p2p_signal',
        'p2p_setting_default',
        'intro_video',
        'theme_change_allow',
        'theme_change_layout',
        'report_issue',
        'reporting_api',
        'report_issue_from_email',
        'report_issue_to_email',
        'mqtt_server',
        'mqtt_endpoint',
        'auto_login',
        'is_catchup',
        'multi_profile',
        'server_selection',
        'app_settings',
        'app_settings_passcode',
        'app_general_settings',
        'multi_profile_auto_login',
        'sub_user_profile',
        'sub_user_profile_allow',
        'sub_user_profile_default',
        'sub_user_profile_setting',
        'sub_user_profile_select_on_start',
        'stream_format',
        'startup_auto_boot',
        'startup_device_select',
        'manual_device_select',
        'detect_default_device',
        'default_device',
        'weather_defult_city',
        'weather_city',
        'weather_city_id',
        'one_signal_app_id',
        'one_signal_rest_key',
        'one_signal_google_project_no'
    ];
}
