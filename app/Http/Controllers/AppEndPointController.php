<?php

namespace App\Http\Controllers;

use App\AppEndPoint;
use Illuminate\Http\Request;

class AppEndPointController extends Controller
{
    public function store(Request $request)
    {
        $endPoint = AppEndPoint::where('app_id', $request->app_id)->first();
        $endPoint->m3u_parse = $request->m3u_parse;
        $endPoint->login = $request->login;
        $endPoint->register = $request->register;
        $endPoint->list_get = $request->list_get;
        $endPoint->list_xstream_update = $request->list_xstream_update;
        $endPoint->deleteurl = $request->deleteurl;
        $endPoint->list_m3u_update = $request->list_m3u_update;
        $endPoint->epg_endpoint = $request->epg_endpoint;
        $endPoint->save();
        $response = [
            'success' => true,
            'message' => 'Endpoint updated.',
        ];
        return response()->json($response, 200);
    }
}
