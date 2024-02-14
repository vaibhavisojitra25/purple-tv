<?php

namespace App\Http\Controllers;

use App\AppSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppSupportController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'support_email' => 'required|email',
            'support_website' => 'required',
            'support_skype_id' => 'required',
            'support_telegram_no' => 'required',
            'support_whatsapp_no' => 'required',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $support = AppSupport::where('app_id', $request->app_id)->first();
            if (empty($support)) {
                $support = new AppSupport();
                $support->app_id = $request->app_id;
            }
            $support->support_email = $request->support_email;
            $support->support_website = $request->support_website;
            $support->support_skype_id = $request->support_skype_id;
            $support->support_telegram_no = $request->support_telegram_no;
            $support->support_whatsapp_no = $request->support_whatsapp_no;
            $support->save();
            $response = [
                'success' => true,
                'message' => 'Support Updated.',
            ];
        }
        return response()->json($response, 200);
    }
}
