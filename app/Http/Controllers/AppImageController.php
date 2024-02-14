<?php

namespace App\Http\Controllers;

use App\AppImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'app_image' => 'required_unless:image_type,remote_image|mimes:jpg,jpeg,png',
        ]);
        $appImage = AppImage::where('app_id', $request->app_id)->first();
        if (empty($appImage)) {
            $appImage = new AppImage();
            $appImage->app_id = $request->app_id;
        }

        if ($request->image_type == 'remote_image') {
            $appImage->app_remote_image = $request->app_remote_image == 'on' ? 1 : 0;
            $appImage->save();
            $response = [
                'success' => true,
                'message' => 'Image updated.',
            ];
        } else {
            if ($request->hasFile('app_image')) {
                $image = $request->file('app_image');
                $name = Str::uuid() . ".png";
                $image->move(public_path('uploads/app_images'), $name);
                $appImage[$request->image_type] = $name;
                $appImage->save();
                $response = [
                    'success' => true,
                    'message' => 'Image updated.',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Please Select Image.',
                ];
            }
        }
        return response()->json($response, 200);
    }
}
