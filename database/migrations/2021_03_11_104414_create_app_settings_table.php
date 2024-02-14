<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->boolean('allow_4k')->default(0);
            $table->string('content_4k')->nullable();
            $table->string('domain_url')->nullable();
            $table->string('login_url')->nullable();
            $table->string('privacy_policy_url')->nullable();
            $table->boolean('private_access')->default(0);
            $table->string('private_video_url')->nullable();
            $table->string('startup_message')->nullable();
            $table->boolean('is_vpn')->default(0);
            $table->boolean('allow_cast')->default(0);
            $table->boolean('remote_support')->default(0);
            $table->boolean('setting_option')->default(0);
            $table->boolean('wifi_option')->default(0);
            $table->boolean('sub_splash')->default(0);
            $table->boolean('vpn_sub_splash')->default(0);
            $table->boolean('vpn_login_screen')->default(0);
            $table->boolean('clear_catch')->default(0);
            $table->boolean('app_list_status')->default(0);
            $table->boolean('private_menu')->default(0);
            $table->boolean('epg_timeshift')->default(0);
            $table->boolean('epg_catchup')->default(0);
            $table->boolean('epg_roku')->default(0);
            $table->boolean('dashbord_ticker')->default(0);
            $table->boolean('login_ticker')->default(0);
            $table->boolean('sub_profile')->default(0);
            $table->boolean('set_default_play')->default(0);
            $table->boolean('set_recent_play')->default(0);
            $table->boolean('remind_me')->default(0);
            $table->boolean('cloud_remind_me')->default(0);
            $table->string('cloud_remind_me_url')->default('0')->nullable();
            $table->boolean('cloud_recording')->default(0);
            $table->boolean('cloud_recent_fav')->default(0);
            $table->string('cloud_recent_fav_url')->nullable();
            $table->boolean('multi_recording')->default(0);
            $table->boolean('recording')->default(0);
            $table->boolean('app_external_plugin')->default(0);
            $table->string('chat_url')->nullable();
            $table->boolean('startup_plugin_install')->default(0);
            $table->boolean('startup_archive_category')->default(0);
            $table->string('header_key')->nullable();
            $table->string('header_value')->nullable();
            $table->string('smtp_server')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_from_email')->nullable();
            $table->boolean('channel_reporting')->default(0);
            $table->string('channel_reporting_to_email')->nullable();
            $table->boolean('movie_show_reqest')->default(0);
            $table->string('movie_show_reqest_to_email')->nullable();
            $table->string('channel_report_email_subject')->nullable();
            $table->string('movie_shows_reqest_email_subject')->nullable();
            $table->boolean('p2p')->default(0);
            $table->string('p2p_signal')->nullable();
            $table->boolean('p2p_setting_default')->default(0);
            $table->boolean('intro_video')->default(0);
            $table->boolean('theme_change_allow')->default(0);
            $table->string('theme_change_layout')->default('0')->nullable();
            $table->boolean('report_issue')->default(0);
            $table->string('reporting_api')->nullable();
            $table->string('report_issue_from_email')->nullable();
            $table->string('report_issue_to_email')->nullable();
            $table->string('mqtt_server')->nullable();
            $table->string('mqtt_endpoint')->nullable();
            $table->boolean('auto_login')->default(0);
            $table->boolean('is_catchup')->default(0);
            $table->boolean('multi_profile')->default(0);
            $table->boolean('server_selection')->default(0);
            $table->boolean('app_settings')->default(0);
            $table->string('app_settings_passcode')->nullable();
            $table->boolean('app_general_settings')->default(0);
            $table->boolean('multi_profile_auto_login')->default(0);
            $table->boolean('sub_user_profile')->default(0);
            $table->string('sub_user_profile_allow')->nullable();
            $table->boolean('sub_user_profile_default')->default(0);
            $table->boolean('sub_user_profile_setting')->default(0);
            $table->boolean('sub_user_profile_select_on_start')->default(0);
            $table->string('stream_format')->nullable();
            $table->boolean('startup_auto_boot')->default(0);
            $table->boolean('startup_device_select')->default(0);
            $table->boolean('manual_device_select')->default(0);
            $table->boolean('detect_default_device')->default(0);
            $table->string('default_device')->nullable();
            $table->string('weather_defult_city')->nullable();
            $table->string('weather_city')->nullable();
            $table->string('weather_city_id')->nullable();
            $table->string('one_signal_app_id')->nullable();
            $table->string('one_signal_rest_key')->nullable();
            $table->string('one_signal_google_project_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('app_id')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
