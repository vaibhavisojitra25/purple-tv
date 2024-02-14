<?php

namespace App\Http\Controllers;

use App\App;
use App\AppAboutUs;
use App\AppAds;
use App\AppApiKey;
use App\AppBackground;
use App\AppEndPoint;
use App\AppImage;
use App\AppLanguage;
use App\AppPlayer;
use App\AppSetting;
use App\AppSupport;
use App\AppTheme;
use App\AppVersion;
use App\AppVpn;
use App\BackgroundUrl;
use App\DnsUrl;
use App\InAppAnnouncement;
use App\InAppPurchase;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
            if ($request->ajax()) {
                $apps = App::has('user')->latest()->get();
                return DataTables::of($apps)
                    ->editColumn('status', function ($row) {
                        switch ($row->status) {
                            case -1:
                                // Pending
                                $title = 'Pending';
                                $class = 'badge-warning';
                                break;
                            case 0:
                                // Inactive
                                $title = 'Inactive';
                                $class = 'badge-secondary';
                                break;
                            case 1:
                                // Active
                                $title = 'Active';
                                $class = 'badge-success';
                                break;
                            case 2:
                                // Rejected
                                $title = 'Rejected';
                                $class = 'badge-danger';
                                break;
                        }
                        if ($row->status == 0 || $row->status == 1) {
                            $value = $row->status == 0 ? 1 : 0;
                            $badge = '<span class="badge badge-pill cursor-pointer py-2 status-badge ' . $class . '" onclick="updateStatus(' . $row->id . "," . $value . ')">' . $title . '</span>';
                        } else {
                            $badge = '<span class="badge badge-pill py-2 status-badge ' . $class . '">' . $title . '</span>';
                        }
                        return $badge;
                    })
                    ->editColumn('created_at', function ($row) {
                        return date('d M Y', strtotime($row->created_at));
                    })
                    ->editColumn('app_icon', function ($row) {
                        if (!empty($row->app_icon)) {
                            return '<img src="' . url('/uploads/apps') . '/' . $row->app_icon . '" width="50px">';
                        } else {
                            return '';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        if ($row->status == -1) {
                            $action .= '<a href="javascript:void(0);" class="action-btn bg-success" onclick="updateStatus(' . $row->id . ", 1, 0" . ')" data-toggle="tooltip" title="Approve">
                                <i class="icon-fa icon-fa-check"></i>
                                </a>
                                <a href="javascript:void(0);" class="action-btn bg-danger" onclick="updateStatus(' . $row->id . ", 2" . ')" data-toggle="tooltip" title="Reject">
                                    <i class="icon-fa icon-fa-times"></i>
                                </a>';
                        } else {
                            $action .= '<a href="' . route('apps.edit', $row->id) . '" class="action-btn bg-warning" data-toggle="tooltip" title="Edit">
                                    <i class="icon-fa icon-fa-pencil-square-o"></i>
                                </a>
                                <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('apps.destroy', $row->id) . '\', \'' . csrf_token() . '\')" data-toggle="tooltip" title="Delete">
                                    <i class="icon-fa icon-fa-trash"></i>
                                </a>
                                <a href="javascript:void(0);" class="action-btn bg-info" onclick="resetApp(' . $row->id . ')" data-toggle="tooltip" title="Reset">
                                    <i class="icon-fa icon-fa-refresh"></i>
                                </a>
                                <a href="' . route('apppermissions.update', $row->id) . '" class="action-btn bg-secondary" data-toggle="tooltip" title="Permission">
                                    <i class="icon-fa icon-fa-cogs"></i>
                                </a>
                                <a href="' . route('apps.show', $row->id) . '" class="action-btn bg-success" data-toggle="tooltip" title="View">
                                    <i class="icon-fa icon-fa-eye"></i>
                                </a> ';
                            if (Auth::user()->id != $row->user_id) {
                                $action .= ' <a href="javascript:void(0);" class="action-btn bg-primary" onclick="takeAccess(\'' . route('impersonate', $row->user_id) . '\', \'' . route('apps.show', $row->id) . '\', \'' . route('impersonate.leave') . '\')" data-toggle="tooltip" title="View As User">
                                    <i class="icon-fa icon-fa-user"></i>
                                </a>';
                            }
                        }
                        return $action;
                    })
                    ->rawColumns(['status', 'app_icon', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.apps.index');
        } else {
            $apps = App::has('user')->where('user_id', Auth::user()->id)->latest()->get();
            return view('admin.apps.index')->with('apps', $apps);
        }
    }

    public function create()
    {
        return view('admin.apps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'package_name' => 'required|unique:apps',
            'app_type' => 'required',
            // 'app_mode' => 'required',
            // 'app_mode_universal' => 'required_if:app_mode,Universal',
            'app_icon' => 'required|mimes:jpg,jpeg,png'
        ]);

        $app = new App();
        $app->app_code = $this->getAppCode();
        $app->user_id = Auth::user()->id;
        $app->app_name = $request->app_name;
        $app->package_name = $request->package_name;
        $app->app_type = implode(',', $request->app_type);
        $app->status = Auth::user()->hasAnyRole(['SuperAdmin', 'Support']) ? $request->status : -1;
        if ($request->has('app_mode') && !empty($request->app_mode)) {
            $app->app_mode = $request->app_mode;
            if ($request->has('app_mode_universal') && !empty($request->app_mode_universal)) {
                $app->app_mode_universal = $request->app_mode_universal;
            }
        } else {
            $app->app_mode = 'Xstream';
        }
        if ($request->hasFile('app_icon')) {
            $image = $request->file('app_icon');
            $name = Str::uuid() . ".png";
            $image->move(public_path('uploads/apps'), $name);
            $app->app_icon = $name;
        }
        $app->save();

        $appImage = new AppImage();
        $appImage->app_id = $app->id;
        $appImage->save();

        $appVersion = new AppVersion();
        $appVersion->app_id = $app->id;
        $appVersion->save();

        $appAboutUs = new AppAboutUs();
        $appAboutUs->app_id = $app->id;
        $appAboutUs->save();

        $appSupport = new AppSupport();
        $appSupport->app_id = $app->id;
        $appSupport->save();

        $appSetting = new AppSetting();
        $appSetting->app_id = $app->id;
        $appSetting->save();

        $appEndPoint = new AppEndPoint();
        $appEndPoint->app_id = $app->id;
        $appEndPoint->save();

        $appApiKey = new AppApiKey();
        $appApiKey->app_id = $app->id;
        $appApiKey->save();

        $appBackground = new AppBackground();
        $appBackground->app_id = $app->id;
        $appBackground->save();

        $appLanguage = new AppLanguage();
        $appLanguage->app_id = $app->id;
        $appLanguage->save();

        $appTheme = new AppTheme();
        $appTheme->app_id = $app->id;
        $appTheme->save();

        $appPlayer = new AppPlayer();
        $appPlayer->app_id = $app->id;
        $appPlayer->save();

        $inAppPurchase = new InAppPurchase();
        $inAppPurchase->app_id = $app->id;
        $inAppPurchase->save();

        $appAds = new AppAds();
        $appAds->app_id = $app->id;
        $appAds->save();

        $appVpn = new AppVpn();
        $appVpn->app_id = $app->id;
        $appVpn->vpn_mode = 'system';
        $appVpn->save();

        $permissions = ["Send Push Notification", "Update Push Notification Settings", "View In-App Announcement", "Create In-App Announcement", "Edit In-App Announcement", "Delete In-App Announcement", "View DNS", "Create DNS", "Edit DNS", "Delete DNS", "View Private Menu", "Create Private Menu", "Edit Private Menu", "Delete Private Menu", "View App Images", "Update App Wide Logo", "Update TV Banner Image", "Update Mobile Icon Image", "Update Background Image", "Update Splash Screen Image", "View App Version", "View App Player", "View About Us", "Update About Us", "View Support", "Update Support", "View VPN Config", "View Theme", "View Background", "Manage App Setting", "View App Configuration", "View Language", "View URL", "View General Setting", "View App Settings", "View Theme Settings", "View Sub User Profile", "View Device Type", "View Ticker Setting", "View Play Setting", "View Default Device", "View In-App Purchase", "View Channel Reporting", "View Movie Show Request", "View Report Issue Email", "View MQTT Setting", "View Header Setting", "View SMTP Setting", "Update SMTP Setting", "View Weather Setting", "View EPG Setting", "View Recording Setting", "View Cloud Setting", "View P2P Setting", "View Stream Setting"];
        $app->syncPermissions($permissions);

        $this->commonResetApp($app->id);

        flash()->success('App created.');
        return redirect()->route('apps.index');
    }

    public function show($id)
    {
        $app = App::find($id);
        $permissions = $app->permissions->pluck('name')->toArray();
        $backgroundImages = [];
        if (isset($app->background->backgroundUrls) && sizeof($app->background->backgroundUrls) > 0) {
            foreach ($app->background->backgroundUrls as $background) {
                $backgroundImages[] = (object) array('id' => $background->id, 'src' => $background->url);
            }
        }
        return view('admin.apps.show')->with('app', $app)->with('permissions', $permissions)->with('backgroundImages', json_encode($backgroundImages));
    }

    public function edit($id)
    {
        $app = App::find($id);
        return view('admin.apps.edit')->with('app', $app);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'app_name' => 'required',
            'package_name' => 'required',
            'app_type' => 'required',
            // 'app_mode' => 'required',
            // 'app_mode_universal' => 'required_if:app_mode,Universal',
            'app_icon' => 'mimes:jpg,jpeg,png'
        ]);

        $app = App::findOrFail($id);
        $app->app_name = $request->app_name;
        $app->package_name = $request->package_name;
        $app->app_type = implode(',', $request->app_type);
        $app->app_mode = $request->app_mode;
        $app->status = Auth::user()->hasAnyRole(['SuperAdmin', 'Support']) ? $request->status : -1;
        if ($request->has('app_mode') && !empty($request->app_mode)) {
            $app->app_mode = $request->app_mode;
            if ($request->app_mode == 'Universal' && $request->has('app_mode_universal')) {
                $app->app_mode_universal = $request->app_mode_universal;
            } else {
                $app->app_mode_universal = null;
            }
        } else {
            $app->app_mode = 'Xstream';
        }
        if ($request->hasFile('app_icon')) {
            $image = $request->file('app_icon');
            $name = Str::uuid() . ".png";
            $image->move(public_path('uploads/apps'), $name);
            $app->app_icon = $name;
        }
        $app->save();
        flash()->success('App updated.');
        return redirect()->route('apps.index');
    }

    public function destroy($id)
    {
        $admin = App::findOrFail($id);
        $admin->delete();
        flash()->success('App deleted.');
        return redirect()->back();
    }

    public function acceptRejectApp(Request $request)
    {
        if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
            $app = App::findOrFail($request->id);
            $app->status = $request->value;
            $app->save();
            $response = [
                'success' => true,
                'message' => 'Status updated',
            ];
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function showAppPermissions($id)
    {
        $app = App::findOrFail($id);
        return view('admin.app-permissions.index')->with('app', $app)->with('permissions', $app->permissions->pluck('name')->toArray());
    }

    public function updateAppPermissions(Request $request, $id)
    {
        $app = App::findOrFail($id);
        $app->syncPermissions($request->permissions);
        $response = [
            'success' => true,
            'message' => 'App permissions updated.',
        ];
        return response()->json($response, 200);
    }

    public function resetApp(Request $request)
    {
        $this->commonResetApp($request->app_id);
        $response = [
            'success' => true,
            'message' => 'Reset successfully.',
        ];
        return response()->json($response, 200);
    }

    function commonResetApp($appId)
    {
        $app = App::findOrFail($appId);
        $defaultConf = config('defaultConf');
        // $app->app_mode = $defaultConf['app_mode'];
        // $app->app_mode_universal = $defaultConf['app_mode_universal'];
        // $app->save();

        $inAppPurchase = InAppPurchase::where('app_id', $appId)->first();
        $inAppPurchase->in_app_status = $defaultConf['in_app_purchase']['in_app_status'];
        $inAppPurchase->in_app_purchase_id = $defaultConf['in_app_purchase']['in_app_purchase_id'];
        $inAppPurchase->in_app_purchase_license_key = $defaultConf['in_app_purchase']['lic_key'];
        $inAppPurchase->save();

        $appAds = AppAds::where('app_id', $appId)->first();
        $appAds->ads_app_id = $defaultConf['ads']['ads_app_id'];
        $appAds->ads_banner = $defaultConf['ads']['ads_banner'];
        $appAds->ads_intrestial = $defaultConf['ads']['ads_intrestial'];
        $appAds->ads_rewarded = $defaultConf['ads']['ads_rewarded'];
        $appAds->ads_native = $defaultConf['ads']['ads_native'];
        $appAds->ads_intrestial_time_delay = $defaultConf['ads']['ads_intrestial_time_delay'];
        $appAds->ads_ios_status = $defaultConf['ads']['ads_ios_status'];
        $appAds->ads_status = $defaultConf['ads']['ads_status'];
        $appAds->save();

        $setting = AppSetting::where('app_id', $appId)->first();
        $setting->allow_4k = $defaultConf['app_conf']['allow_4k'];
        $setting->content_4k = $defaultConf['app_conf']['content_4k'];
        $setting->domain_url = $defaultConf['app_conf']['domain_url'];
        $setting->login_url = $defaultConf['app_conf']['login_url'];
        $setting->privacy_policy_url = $defaultConf['app_conf']['privacy_policy'];
        $setting->private_access = $defaultConf['app_conf']['private_access'];
        $setting->private_video_url = $defaultConf['app_conf']['private_video_url'];
        $setting->startup_message = $defaultConf['app_conf']['startup_msg'];
        $setting->is_vpn = $defaultConf['app_conf']['vpn'];
        $setting->allow_cast = $defaultConf['app_conf']['allow_cast'];
        $setting->remote_support = $defaultConf['app_conf']['remote_support'];
        $setting->setting_option = $defaultConf['app_conf']['setting_option'];
        $setting->wifi_option = $defaultConf['app_conf']['wifi_option'];
        $setting->sub_splash = $defaultConf['app_conf']['sub_splash'];
        $setting->vpn_sub_splash = $defaultConf['app_conf']['vpn_sub_splash'];
        $setting->vpn_login_screen = $defaultConf['app_conf']['vpn_login_screen'];
        $setting->clear_catch = $defaultConf['app_conf']['clear_catch'];
        $setting->app_list_status = $defaultConf['app_conf']['app_list_status'];
        $setting->private_menu = $defaultConf['app_conf']['private_menu'];
        $setting->epg_timeshift = $defaultConf['app_conf']['epg_timeshift'];
        $setting->epg_catchup = $defaultConf['app_conf']['epg_catchup'];
        $setting->is_catchup = $defaultConf['app_conf']['catchup'];
        $setting->epg_roku = $defaultConf['app_conf']['epg_roku'];
        $setting->dashbord_ticker = $defaultConf['app_conf']['dashbord_ticker'];
        $setting->login_ticker = $defaultConf['app_conf']['login_ticker'];
        $setting->sub_profile = $defaultConf['app_conf']['sub_profile'];
        $setting->set_default_play = $defaultConf['app_conf']['set_default_play'];
        $setting->set_recent_play = $defaultConf['app_conf']['set_recent_play'];
        $setting->remind_me = $defaultConf['app_conf']['remind_me'];
        $setting->cloud_remind_me = $defaultConf['app_conf']['cloud_remind_me'];
        $setting->cloud_remind_me_url = $defaultConf['app_conf']['cloud_remind_me_url'];
        $setting->cloud_recording = $defaultConf['app_conf']['cloud_recording'];
        $setting->cloud_recent_fav = $defaultConf['app_conf']['cloud_recent_fav'];
        $setting->cloud_recent_fav_url = $defaultConf['app_conf']['cloud_recent_fav_url'];
        $setting->multi_recording = $defaultConf['app_conf']['multi_recording'];
        $setting->recording = $defaultConf['app_conf']['recording'];
        $setting->app_external_plugin = $defaultConf['app_conf']['app_external_plugin'];
        $setting->chat_url = $defaultConf['app_conf']['chat_url'];
        $setting->startup_plugin_install = $defaultConf['app_conf']['startup_plugin_install'];
        $setting->startup_archive_category = $defaultConf['app_conf']['startup_archive_category'];
        $setting->header_key = $defaultConf['app_conf']['header_key'];
        $setting->header_value = $defaultConf['app_conf']['header_value'];
        $setting->smtp_server = $defaultConf['app_conf']['smtp_server'];
        $setting->smtp_port = $defaultConf['app_conf']['smtp_port'];
        $setting->smtp_username = $defaultConf['app_conf']['smtp_username'];
        $setting->smtp_password = $defaultConf['app_conf']['smtp_password'];
        $setting->smtp_from_email = $defaultConf['app_conf']['smtp_from_email'];
        $setting->channel_reporting = $defaultConf['app_conf']['channel_reporting'];
        $setting->channel_reporting_to_email = $defaultConf['app_conf']['channel_reporting_to_email'];
        $setting->movie_show_reqest = $defaultConf['app_conf']['movie_show_reqest'];
        $setting->movie_show_reqest_to_email = $defaultConf['app_conf']['movie_show_reqest_to_email'];
        $setting->channel_report_email_subject = $defaultConf['app_conf']['channel_report_email_subject'];
        $setting->movie_shows_reqest_email_subject = $defaultConf['app_conf']['movie_shows_reqest_email_subject'];
        $setting->p2p = $defaultConf['app_conf']['p2p'];
        $setting->p2p_signal = $defaultConf['app_conf']['p2p_signal'];
        $setting->p2p_setting_default = $defaultConf['app_conf']['p2p_setting_default'];
        $setting->intro_video = $defaultConf['app_conf']['intro_video'];
        $setting->theme_change_allow = $defaultConf['app_conf']['theme_change_allow'];
        $setting->theme_change_layout = $defaultConf['app_conf']['theme_change_layout'];
        $setting->report_issue = $defaultConf['app_conf']['report_issue'];
        $setting->reporting_api = $defaultConf['app_conf']['reporting_api'];
        $setting->report_issue_from_email = $defaultConf['app_conf']['report_issue_from_email'];
        $setting->report_issue_to_email = $defaultConf['app_conf']['report_issue_to_email'];
        $setting->mqtt_server = $defaultConf['app_conf']['mqtt_server'];
        $setting->mqtt_endpoint = $defaultConf['app_conf']['mqtt_endpoint'];
        $setting->auto_login = $defaultConf['app_conf']['auto_login'];
        $setting->multi_profile = $defaultConf['app_conf']['multi_profile'];
        $setting->weather_defult_city = $defaultConf['app_conf']['weather_defult_city'];
        $setting->server_selection = $defaultConf['app_conf']['server_selection'];
        $setting->app_settings = $defaultConf['app_conf']['app_settings'];
        $setting->app_settings_passcode = $defaultConf['app_conf']['app_settings_passcode'];
        $setting->app_general_settings = $defaultConf['app_conf']['app_general_settings'];
        $setting->multi_profile_auto_login = $defaultConf['app_conf']['multi_profile_auto_login'];
        $setting->sub_user_profile = $defaultConf['app_conf']['sub_user_profile'];
        $setting->sub_user_profile_allow = $defaultConf['app_conf']['sub_user_profile_allow'];
        $setting->sub_user_profile_default = $defaultConf['app_conf']['sub_user_profile_default'];
        $setting->sub_user_profile_setting = $defaultConf['app_conf']['sub_user_profile_setting'];
        $setting->sub_user_profile_select_on_start = $defaultConf['app_conf']['sub_user_profile_select_on_start'];
        $setting->stream_format = $defaultConf['app_conf']['stream_format'];
        $setting->startup_auto_boot = $defaultConf['app_conf']['startup_auto_boot'];
        $setting->startup_device_select = $defaultConf['app_conf']['startup_device_select'];
        $setting->manual_device_select = $defaultConf['app_conf']['manual_device_select'];
        $setting->detect_default_device = $defaultConf['app_conf']['default_device_select']['detect'];
        $setting->default_device = $defaultConf['app_conf']['default_device_select']['device'];
        $setting->one_signal_app_id = $defaultConf['app_conf']['one_signal_app_id'];
        $setting->one_signal_rest_key = $defaultConf['app_conf']['one_signal_rest_key'];
        $setting->one_signal_google_project_no = $defaultConf['app_conf']['one_signal_google_project_no'];
        $setting->weather_city = $defaultConf['weather']['city_name'];
        $setting->weather_city_id = $defaultConf['weather']['city_id'];
        $setting->save();

        $appImage = AppImage::where('app_id', $appId)->first();
        $appImage->app_wide_logo = $defaultConf['app_image']['app_logo'];
        $appImage->tv_banner_image = $defaultConf['app_image']['app_tv_banner'];
        $appImage->app_mobile_icon_image = $defaultConf['app_image']['app_mobile_icon'];
        $appImage->app_background = $defaultConf['app_image']['back_image'];
        $appImage->app_splash_screen = $defaultConf['app_image']['splash_image'];
        $appImage->app_remote_image = $defaultConf['app_image']['app_img'];
        $appImage->save();

        $aboutUs = AppAboutUs::where('app_id', $appId)->first();
        $aboutUs->description = $defaultConf['about']['description'];
        $aboutUs->developed_by = $defaultConf['about']['developed'];
        $aboutUs->about_skype_id = $defaultConf['about']['skype'];
        $aboutUs->about_telegram_no = $defaultConf['about']['telegram'];
        $aboutUs->about_whatsapp_no = $defaultConf['about']['whatsapp'];
        $aboutUs->save();

        $support = AppSupport::where('app_id', $appId)->first();
        $support->support_email = $defaultConf['support']['email'];
        $support->support_website = $defaultConf['support']['web'];
        $support->support_skype_id = $defaultConf['support']['skype'];
        $support->support_telegram_no = $defaultConf['support']['telegram'];
        $support->support_whatsapp_no = $defaultConf['support']['whatsapp'];
        $support->save();

        $vpn = AppVpn::where('app_id', $appId)->first();
        $vpn->vpn_mode = $defaultConf['vpn']['vpn_mode'];
        $vpn->vpn_username = $defaultConf['vpn']['vpn_username'];
        $vpn->vpn_password = $defaultConf['vpn']['vpn_password'];
        $vpn->save();

        $appVersion = AppVersion::where('app_id', $appId)->first();
        $appVersion->version_check = $defaultConf['version']['version_check'];
        $appVersion->version_update_message = $defaultConf['version']['version_update_msg'];
        $appVersion->version_code = $defaultConf['version']['version_code'];
        $appVersion->version_name = $defaultConf['version']['version_name'];
        $appVersion->play_store_url = $defaultConf['version']['version_download_url'];
        $appVersion->apk_url = $defaultConf['version']['version_download_url_apk'];
        $appVersion->force_update = $defaultConf['version']['version_force_update'];
        $appVersion->save();

        $endPoint = AppEndPoint::where('app_id', $appId)->first();
        $endPoint->m3u_parse = $defaultConf['endpoint']['m3u_parse'];
        $endPoint->login = $defaultConf['endpoint']['login'];
        $endPoint->register = $defaultConf['endpoint']['register'];
        $endPoint->list_get = $defaultConf['endpoint']['list_get'];
        $endPoint->list_xstream_update = $defaultConf['endpoint']['list_xstream_update'];
        $endPoint->deleteurl = $defaultConf['endpoint']['deleteurl'];
        $endPoint->list_m3u_update = $defaultConf['endpoint']['list_m3u_update'];
        $endPoint->epg_endpoint = $defaultConf['endpoint']['epg_endpoint'];
        $endPoint->save();

        $endPoint = AppApiKey::where('app_id', $appId)->first();
        $endPoint->imdb_api = $defaultConf['api_key']['imdb_api'];
        $endPoint->g_api_key = $defaultConf['api_key']['g_api_key'];
        $endPoint->image_imdb = $defaultConf['api_key']['image_imdb'];
        $endPoint->weather_api = $defaultConf['api_key']['weather_api'];
        $endPoint->trakt_api_key = $defaultConf['api_key']['trakt_api_key'];
        $endPoint->ip_stack_key = $defaultConf['api_key']['ip_stack_key'];
        $endPoint->check_ip = $defaultConf['api_key']['check_ip'];
        $endPoint->save();

        $background = AppBackground::where('app_id', $appId)->first();
        $background->background_auto_change = $defaultConf['background']['background_auto_change'];
        $background->background_mannual_change = $defaultConf['background']['background_mannual_change'];
        $background->back_remote_change = $defaultConf['background']['back_remote_change'];
        $background->back_orverlay_remote_change = $defaultConf['background']['back_orverlay_remote_change'];
        $background->background_orverlay_color_code = $defaultConf['background']['background_orverlay_color_code'];
        $background->save();

        BackgroundUrl::where('app_background_id', $background->id)->delete();

        $language = AppLanguage::where('app_id', $appId)->first();
        $language->defult_language = $defaultConf['language']['defult_language'];
        $language->firstime_select_language = $defaultConf['language']['firstime_select_language'];
        $language->save();

        $theme = AppTheme::where('app_id', $appId)->first();
        $theme->theme_defult_layout = $defaultConf['themes']['theme_defult_layout'];
        $theme->theme_color_1 = $defaultConf['themes']['theme_color_1'];
        $theme->theme_color_2 = $defaultConf['themes']['theme_color_2'];
        $theme->theme_color_3 = $defaultConf['themes']['theme_color_3'];
        $theme->roku_color_primary = $defaultConf['themes']['roku_color_primary'];
        $theme->roku_color_secondary = $defaultConf['themes']['roku_color_secondary'];
        $theme->roku_button_focus = $defaultConf['themes']['roku_button_focus'];
        $theme->roku_button_unfocus = $defaultConf['themes']['roku_button_unfocus'];
        $theme->theme_change = $defaultConf['themes']['theme_change'];
        $theme->roku_background_overlay = $defaultConf['themes']['roku_background_overlay'];
        $theme->save();

        $appPlayer = AppPlayer::where('app_id', $appId)->first();
        $appPlayer->live_tv = $defaultConf['player']['live_tv'];
        $appPlayer->vod = $defaultConf['player']['vod'];
        $appPlayer->series = $defaultConf['player']['series'];
        $appPlayer->catch_up = $defaultConf['player']['catch_up'];
        $appPlayer->save();

        InAppAnnouncement::where('app_id', $appId)->delete();
        DnsUrl::where('app_id', $appId)->delete();
    }

    function getAppCode()
    {
        $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
        $check = App::where('app_code', $code)->first();
        if (!empty($check)) {
            return $this->getAppCode();
        } else {
            return $code;
        }
    }
}
