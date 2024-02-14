<?php

namespace App\Http\Controllers;

use App\AppTheme;
use Illuminate\Http\Request;

class AppThemeController extends Controller
{
    public function store(Request $request)
    {
        $theme = AppTheme::where('app_id', $request->app_id)->first();
        $theme->theme_defult_layout = $request->theme_defult_layout;
        $theme->theme_color_1 = $request->theme_color_1;
        $theme->theme_color_2 = $request->theme_color_2;
        $theme->theme_color_3 = $request->theme_color_3;
        $theme->roku_color_primary = $request->roku_color_primary;
        $theme->roku_color_secondary = $request->roku_color_secondary;
        $theme->roku_button_focus = $request->roku_button_focus;
        $theme->roku_button_unfocus = $request->roku_button_unfocus;
        $theme->theme_change = $request->theme_change == 'on' ? 1 : 0;
        $theme->roku_background_overlay = $request->roku_background_overlay;
        $theme->save();
        $response = [
            'success' => true,
            'message' => 'Theme updated.',
        ];
        return response()->json($response, 200);
    }
}
