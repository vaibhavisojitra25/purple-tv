<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppConfResource extends JsonResource
{

    protected $package_name;

    public function additional($value)
    {
        $this->package_name = $value;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'allow_4k' => $this->allow_4k == 1 ? "true" : "false",
            'content_4k' => $this->content_4k ?: '',
            'domain_url' => $this->domain_url ?: '',
            'login_url' => $this->login_url ?: '',
            'package_name' => $this->package_name,
            'privacy_policy' => $this->privacy_policy_url ?: '',
            'private_access' => $this->private_access == 1 ? "true" : "false",
            'private_video_url' => $this->private_video_url ?: '',
            'startup_msg' => $this->startup_message ?: '',
            'vpn' => $this->is_vpn == 1 ? "true" : "false",
            'vpn_sub_splash' => $this->vpn_sub_splash == 1 ? "true" : "false",
            'vpn_login_screen' => $this->vpn_login_screen == 1 ? "true" : "false",
            'allow_cast' => $this->allow_cast == 1 ? "true" : "false",
            'remote_support' => $this->remote_support == 1 ? "true" : "false",
            'setting_option' => $this->setting_option == 1 ? "true" : "false",
            'wifi_option' => $this->wifi_option == 1 ? "true" : "false",
            'sub_splash' => $this->sub_splash == 1 ? "true" : "false",
            'clear_catch' => $this->clear_catch == 1 ? "true" : "false",
            'app_list_status' => $this->app_list_status == 1 ? "true" : "false",
            'private_menu' => $this->private_menu == 1 ? "true" : "false",
            'epg_timeshift' => $this->epg_timeshift == 1 ? "true" : "false",
            'epg_catchup' => $this->epg_catchup == 1 ? "true" : "false",
            'catchup' => $this->is_catchup == 1 ? "true" : "false",
            'epg_roku' => $this->epg_roku == 1 ? "true" : "false",
            'dashbord_ticker' => $this->dashbord_ticker == 1 ? "true" : "false",
            'login_ticker' => $this->login_ticker == 1 ? "true" : "false",
            'sub_profile' => $this->sub_profile == 1 ? "true" : "false",
            'set_default_play' => $this->set_default_play == 1 ? "true" : "false",
            'set_recent_play' => $this->set_recent_play == 1 ? "true" : "false",
            'remind_me' => $this->remind_me == 1 ? "true" : "false",
            'cloud_remind_me' => $this->cloud_remind_me == 1 ? "true" : "false",
            'cloud_remind_me_url' => $this->cloud_remind_me_url ?: '',
            'cloud_recording' => $this->cloud_recording == 1 ? "true" : "false",
            'cloud_recent_fav' => $this->cloud_recent_fav == 1 ? "true" : "false",
            'cloud_recent_fav_url' => $this->cloud_recent_fav_url ?: '',
            'multi_recording' => $this->multi_recording == 1 ? "true" : "false",
            'recording' => $this->recording == 1 ? "true" : "false",
            'app_external_plugin' => $this->app_external_plugin == 1 ? "true" : "false",
            'chat_url' => $this->chat_url ?: '',
            'startup_plugin_install' => $this->startup_plugin_install == 1 ? "true" : "false",
            'startup_archive_category' => $this->startup_archive_category == 1 ? "true" : "false",
            'header_key' => $this->header_key ?: '',
            'header_value' => $this->header_value ?: '',
            'smtp_server' => $this->smtp_server ?: '',
            'smtp_port' => $this->smtp_port ?: '',
            'smtp_username' => $this->smtp_username ?: '',
            'smtp_password' => $this->smtp_password ?: '',
            'smtp_from_email' => $this->smtp_from_email ?: '',
            'channel_reporting' => $this->channel_reporting == 1 ? "true" : "false",
            'channel_reporting_to_email' => $this->channel_reporting_to_email ?: '',
            'movie_show_reqest' => $this->movie_show_reqest == 1 ? "true" : "false",
            'movie_show_reqest_to_email' => $this->movie_show_reqest_to_email ?: '',
            'channel_report_email_subject' => $this->channel_report_email_subject ?: '',
            'movie_shows_reqest_email_subject' => $this->movie_shows_reqest_email_subject ?: '',
            'p2p' => $this->p2p == 1 ? "true" : "false",
            'p2p_signal' => $this->p2p_signal ?: '',
            'p2p_setting_default' => $this->p2p_setting_default == 1 ? "true" : "false",
            'intro_video' => $this->intro_video == 1 ? "true" : "false",
            'theme_change_allow' => $this->theme_change_allow == 1 ? "true" : "false",
            'theme_change_layout' => $this->theme_change_layout ?: '0',
            'report_issue_from_email' => $this->report_issue_from_email ?: '',
            'report_issue_to_email' => $this->report_issue_to_email ?: '',
            'report_issue' => $this->report_issue == 1? "true" : "false",
            'reporting_api' => $this->reporting_api ?: '',
            'mqtt_server' => $this->mqtt_server ?: '',
            'mqtt_endpoint' => $this->mqtt_endpoint ?: '',
            'auto_login' => $this->auto_login == 1 ? "true" : "false",
            'multi_profile' => $this->multi_profile == 1 ? "true" : "false",
            // 'weather_defult_city' => $this->weather_defult_city ?: '',
            'server_selection' => $this->server_selection == 1 ? "true" : "false",
            'app_settings' => $this->app_settings == 1 ? "true" : "false",
            'app_settings_passcode' => $this->app_settings_passcode ?: '',
            'app_general_settings' => $this->app_general_settings == 1 ? "true" : "false",
            'multi_profile_auto_login' => $this->multi_profile_auto_login == 1 ? "true" : "false",
            'sub_user_profile' => $this->sub_user_profile == 1 ? "true" : "false",
            'sub_user_profile_allow' => $this->sub_user_profile_allow ?: '',
            'sub_user_profile_default' => $this->sub_user_profile_default == 1 ? "true" : "false",
            'sub_user_profile_setting' => $this->sub_user_profile_setting == 1 ? "true" : "false",
            'sub_user_profile_select_on_start' => $this->sub_user_profile_select_on_start == 1 ? "true" : "false",
            'stream_format' => $this->stream_format ?: '',
            'startup_auto_boot' => $this->startup_auto_boot == 1 ? "true" : "false",
            'startup_device_select' => $this->startup_device_select == 1 ? "true" : "false",
            'manual_device_select' => $this->manual_device_select == 1 ? "true" : "false",
            'default_device_select' => (object) array('detect' => $this->detect_default_device == 1 ? "true" : "false", 'device' => $this->default_device ?: ''),
            // 'one_signal_app_id' => $this->one_signal_app_id ?: '',
            // 'one_signal_rest_key' => $this->one_signal_rest_key ?: '',
            // 'one_signal_google_project_no' => $this->one_signal_google_project_no ?: '',
        ];
    }
}
