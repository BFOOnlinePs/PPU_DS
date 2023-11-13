<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions;

use App\Http\Controllers\Controller;
use App\Models\FCMRegistrationTokens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FCMController extends Controller
{
    public function storeFcmUserToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'frt_user_id' => 'required',
            'frt_registration_token' => 'required',
        ], [
            'frt_user_id.required' => 'الرجاء ارسال رقم المستخدم',
            'frt_registration_token.required' => 'الرجاء ارسال التوكين المراد تخزينه',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $fcmUserToken = FCMRegistrationTokens::create([
            'frt_user_id' => $request->input('frt_user_id'),
            'frt_registration_token' => $request->input('frt_registration_token'),
            'frt_date' =>  Carbon::now()->format('Y-m-d'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تخزين التوكين',
            'data' => $fcmUserToken
        ]);
    }

    public function updateFcmUserToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'frt_user_id' => 'required',
            'frt_registration_token' => 'required',
        ], [
            'frt_user_id.required' => 'الرجاء ارسال رقم المستخدم',
            'frt_registration_token.required' => 'الرجاء ارسال التوكين المراد تخزينه',
        ]);

        // update the token
        // $fcmUserToken;

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث التوكين',
            // 'data' => $fcmUserToken
        ]);
    }

    public function deleteFcmUserToken(Request $request)
    {
        // delete the token

        return response()->json([
            'status' => true,
            'message' => 'تم حذف التوكين',
        ]);
    }
}
