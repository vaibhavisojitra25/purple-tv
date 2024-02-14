<?php

namespace App\Http\Controllers;

use App\AppVpn;
use Illuminate\Http\Request;

class AppVpnController extends Controller
{
    public function store(Request $request)
    {
        $vpn = AppVpn::where('app_id', $request->app_id)->first();
        $vpn->vpn_mode = $request->vpn_mode;
        $vpn->vpn_username = $request->vpn_username;
        $vpn->vpn_password = $request->vpn_password;
        $vpn->save();
        $response = [
            'success' => true,
            'message' => 'VPN updated.',
        ];
        return response()->json($response, 200);
    }
}
