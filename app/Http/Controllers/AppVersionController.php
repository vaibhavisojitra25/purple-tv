<?php

namespace App\Http\Controllers;

use App\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppVersionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'version_update_message' => 'required',
            'version_code' => 'required',
            'version_name' => 'required',
            'play_store_url' => 'required',
            'apk_url' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $appVersion = AppVersion::where('app_id', $request->app_id)->first();
            if (empty($appVersion)) {
                $appVersion = new AppVersion();
                $appVersion->app_id = $request->app_id;
            }
            $appVersion->version_check = $request->version_check == 'on' ? 1 : 0;
            $appVersion->version_update_message = $request->version_update_message;
            $appVersion->version_code = $request->version_code;
            $appVersion->version_name = $request->version_name;
            $appVersion->play_store_url = $request->play_store_url;
            $appVersion->apk_url = $request->apk_url;
            $appVersion->force_update = $request->force_update == 'on' ? 1 : 0;
            $appVersion->save();
            $response = [
                'success' => true,
                'message' => 'Version updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
