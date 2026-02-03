<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\ProfileField;
use App\Models\Setting;
use App\Models\User; // 👈 این خط مهمه
use App\Http\Requests\StoreProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfileFieldValue;

class ProfileController extends Controller
{

    public function show()
    {
        $profile = auth()->user()->profile;

        $fields = \App\Models\ProfileField::where('enabled', true)->get();

        return view('complete-profile', compact('profile', 'fields'));
    }



    public function store(Request $request)
    {
        $user = auth()->user();

        // فیلدهای ثابت پروفایل
        $data = $request->validate([
            'full_name'   => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'regex:/^\d{10}$/'],
            'address'     => ['nullable', 'string'],
            'mobile'      => ['nullable', 'regex:/^09\d{9}$/'],
            'lat'         => ['nullable', 'numeric'],
            'lng'         => ['nullable', 'numeric'],
        ]);

        $profile = $user->profile ?: new \App\Models\Profile(['user_id' => $user->id]);
        $profile->fill($data);
        $profile->save();

        // ✅ ذخیره فیلدهای داینامیک
        $fields = \App\Models\ProfileField::where('enabled', true)->get();

        foreach ($fields as $field) {
            $value = $request->input($field->key);

            \App\Models\ProfileFieldValue::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'profile_field_id' => $field->id,
                ],
                [
                    'value' => $value,
                ]
            );

            $mapFieldIsRequired = \App\Models\ProfileField::where('type', 'map')
                ->where('required', true)
                ->where('enabled', true)
                ->exists();

            if ($mapFieldIsRequired) {
                $request->validate([
                    'lat' => ['required', 'numeric'],
                    'lng' => ['required', 'numeric'],
                ], [
                    'lat.required' => 'لطفاً موقعیت مکانی را روی نقشه انتخاب کنید',
                    'lng.required' => 'لطفاً موقعیت مکانی را روی نقشه انتخاب کنید',
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'پروفایل با موفقیت ذخیره شد');
    }
}
