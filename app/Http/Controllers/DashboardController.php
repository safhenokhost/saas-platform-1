<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $formEnabled = Setting::where('key', 'profile_form_enabled')->value('value');

        // فقط وقتی فرم فعاله و پروفایل نداره، بفرست تکمیل پروفایل
        if ($formEnabled === '1' && !$user->profile) {
            return redirect()->route('profile.show');
        }

        return view('dashboard');
    }
}
