<?php

namespace App\Http\Controllers;

use App\AppBackground;
use App\BackgroundUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppBackgroundController extends Controller
{
    public function store(Request $request)
    {
        $background = AppBackground::where('app_id', $request->app_id)->first();
        $background->background_auto_change = $request->background_auto_change == 'on' ? 1 : 0;
        $background->background_mannual_change = $request->background_mannual_change == 'on' ? 1 : 0;
        $background->back_remote_change = $request->back_remote_change == 'on' ? 1 : 0;
        $background->back_orverlay_remote_change = $request->back_orverlay_remote_change == 'on' ? 1 : 0;
        $background->background_orverlay_color_code = $request->background_orverlay_color_code;
        $background->save();

        if ($request->has('old_background_images')) {
            BackgroundUrl::where('app_background_id', $background->id)->whereNotIn('id', $request->old_background_images)->delete();
        }

        if ($request->hasFile('background_images')) {
            $images = $request->file('background_images');
            foreach ($images as $image) {
                $name = Str::uuid() . "." . $image->extension();
                $image->move(public_path('uploads/app_backgrounds'), $name);

                $backgroundUrl = new BackgroundUrl();
                $backgroundUrl->app_background_id = $background->id;
                $backgroundUrl->url = url('uploads/app_backgrounds', $name);
                $backgroundUrl->save();
            }
        }

        $response = [
            'success' => true,
            'message' => 'Background updated.',
        ];
        return response()->json($response, 200);
    }
}
