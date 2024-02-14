<?php

namespace App\Http\Controllers;

use App\AppApiKey;
use Illuminate\Http\Request;

class AppApiKeyController extends Controller
{

    public function store(Request $request)
    {
        $endPoint = AppApiKey::where('app_id', $request->app_id)->first();
        $endPoint->imdb_api = $request->imdb_api;
        $endPoint->g_api_key = $request->g_api_key;
        $endPoint->image_imdb = $request->image_imdb;
        $endPoint->weather_api = $request->weather_api;
        $endPoint->trakt_api_key = $request->trakt_api_key;
        $endPoint->ip_stack_key = $request->ip_stack_key;
        $endPoint->check_ip = $request->check_ip;
        $endPoint->save();
        $response = [
            'success' => true,
            'message' => 'Api key updated.',
        ];
        return response()->json($response, 200);
    }
}
