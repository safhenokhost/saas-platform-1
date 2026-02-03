<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileFieldController;
use App\Http\Middleware\EnsureProfileIsComplete;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return 'Laravel is OK ✅';
});

// ================= AUTH =================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= LOGGED IN =================
Route::middleware('auth')->group(function () {

    // تکمیل پروفایل
    Route::get('/complete-profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::post('/complete-profile', [ProfileController::class, 'store'])
        ->name('profile.store');

    // داشبورد (با اجبار تکمیل پروفایل)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(EnsureProfileIsComplete::class)
        ->name('dashboard');

    // خروج اجباری برای تست
    Route::get('/force-logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('force.logout');
});

// ================= ADMIN =================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // لیست فیلدها
    Route::get('/profile-fields', [ProfileFieldController::class, 'index'])->name('admin.profile-fields.index');
    // ساخت فیلد جدید
    Route::post('/profile-fields', [ProfileFieldController::class, 'store'])->name('admin.profile-fields.store');

    // ویرایش فیلد
    Route::put('/profile-fields/{id}', [ProfileFieldController::class, 'update'])->name('admin.profile-fields.update');

    // حذف فیلد
    Route::delete('/profile-fields/{id}', [ProfileFieldController::class, 'destroy'])->name('admin.profile-fields.destroy');

    // فعال / غیرفعال فیلد
    Route::post('/profile-fields/{field}/toggle', [ProfileFieldController::class, 'toggle'])
        ->name('admin.profile-fields.toggle');

    // فعال / غیرفعال کل فرم تکمیل پروفایل
    Route::post('/profile-form/toggle', [ProfileFieldController::class, 'toggleForm'])
        ->name('admin.profile-form.toggle');

    // تنظیمات کلی (در صورت نیاز)
    Route::post(
        '/settings/toggle-complete-profile',
        [SettingController::class, 'toggleCompleteProfile']
    )->name('admin.settings.toggle-complete-profile');
});






