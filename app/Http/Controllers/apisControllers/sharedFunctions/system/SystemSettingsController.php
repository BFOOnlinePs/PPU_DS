<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\system;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function getSystemSettings(Request $request){
        $systemSettings = SystemSetting::first();
        return response()->json([
            'status' => true,
            'systemSettings' => $systemSettings
        ]);
    }
}
