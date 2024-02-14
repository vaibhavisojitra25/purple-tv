<?php

namespace App\Http\Controllers;

use App\AppLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppLanguageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'defult_language' => 'required'
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $language = AppLanguage::where('app_id', $request->app_id)->first();
            $language->defult_language = $request->defult_language;
            $language->firstime_select_language = $request->firstime_select_language == 'on' ? 1 : 0;
            $language->save();
            $response = [
                'success' => true,
                'message' => 'Language updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
