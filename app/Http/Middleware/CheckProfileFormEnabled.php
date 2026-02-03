<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class CheckProfileFormEnabled
{
    public function handle($request, Closure $next)
    {
        if (Setting::get('profile_form_enabled', '1') !== '1') {
            return redirect()->route('dashboard')
                ->with('error', 'فرم تکمیل پروفایل توسط ادمین غیرفعال شده است.');
        }

        return $next($request);
    }
}
