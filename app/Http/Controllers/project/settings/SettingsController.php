<?php

namespace App\Http\Controllers\project\settings;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $system_settings = SystemSetting::first();
        $background_color = $system_settings->ss_primary_background_color;
        $text_color = $system_settings->ss_primary_font_color;
        return view('project.admin.settings.coloring' , ['background_color' => $background_color, 'text_color' => $text_color]);
    }
    public function primary_background_color(Request $request)
    {
        $system_settings = SystemSetting::first();
        $system_settings->ss_primary_background_color = $request->color_value;
        if($system_settings->save()) {
            return response()->json([]);
        }
    }
    public function primary_font_color(Request $request)
    {
        $system_settings = SystemSetting::first();
        $system_settings->ss_primary_font_color = $request->color_value;
        if($system_settings->save()) {
            return response()->json([]);
        }
    }
}
