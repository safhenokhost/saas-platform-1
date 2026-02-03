<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function toggleCompleteProfile()
    {
        $setting = Setting::firstOrCreate(
            ['key' => 'force_complete_profile'],
            ['value' => 1]
        );

        $setting->value = $setting->value ? 0 : 1;
        $setting->save();

        return back()->with('success', 'وضعیت اجبار تکمیل پروفایل تغییر کرد');
    }
}
