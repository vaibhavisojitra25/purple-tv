<?php

namespace App\Http\Controllers;

use App\AppPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppPlayerController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'live_tv' => 'required',
            'vod' => 'required',
            'series' => 'required',
            'catchup' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $appPlayer = AppPlayer::where('app_id', $request->app_id)->first();
            $appPlayer->live_tv = $request->live_tv;
            $appPlayer->vod = $request->vod;
            $appPlayer->series = $request->series;
            $appPlayer->catch_up = $request->catchup;
            $appPlayer->save();
            $response = [
                'success' => true,
                'message' => 'Player updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
