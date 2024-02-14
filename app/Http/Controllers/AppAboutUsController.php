<?php

namespace App\Http\Controllers;

use App\AppAboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppAboutUsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'developed_by' => 'required',
            'about_skype_id' => 'required',
            'about_telegram_no' => 'required',
            'about_whatsapp_no' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $aboutUs = AppAboutUs::where('app_id', $request->app_id)->first();
            if (empty($aboutUs)) {
                $aboutUs = new AppAboutUs();
                $aboutUs->app_id = $request->app_id;
            }
            $aboutUs->description = $request->description;
            $aboutUs->developed_by = $request->developed_by;
            $aboutUs->about_skype_id = $request->about_skype_id;
            $aboutUs->about_telegram_no = $request->about_telegram_no;
            $aboutUs->about_whatsapp_no = $request->about_whatsapp_no;
            $aboutUs->save();
            $response = [
                'success' => true,
                'message' => 'About Us Updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
