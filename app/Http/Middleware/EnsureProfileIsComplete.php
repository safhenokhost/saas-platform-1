<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // اگر لاگین نیست
        if (! $user) {
            return redirect()->route('login');
        }

        // بررسی فعال بودن اجبار تکمیل پروفایل
        $force = Setting::where('key', 'force_complete_profile')->value('value');

        // اگر اجبار غیرفعال است → اجازه ورود بده
        if (! $force) {
            return $next($request);
        }

        // اگر پروفایل وجود ندارد یا کامل نیست → هدایت به فرم تکمیل
        if (! $user->profile || ! $user->profile->is_complete) {
            if (! $request->routeIs('profile.show', 'profile.store')) {
                return redirect()->route('profile.show');
            }
        }

        return $next($request);
    }
}
