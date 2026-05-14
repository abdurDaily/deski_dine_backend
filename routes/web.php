<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\NotificationController;

Route::get('/', function ()
{
    return to_route('login');
});

Auth::routes(['register' => false, 'verify' => true]);

Route::get('/run-migrations', function (Request $request)
{
    if ($request->input('key') !== MIGRATION_KEY)
    {
        abort(403, 'Unauthorized');
    }
    Artisan::call('migrate', ["--force" => true]);
    Artisan::call('db:seed', ["--force" => true]);
    return 'Migrations ran successfully';
});

Route::get('/linkstorage', function ()
{
    Artisan::call('storage:link');
});

Route::get('cache-clear', function ()
{
    try
    {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        Cache::flush();
        Artisan::call('cache:forget spatie.permission.cache');
        return response()->json(['status' => 'success', 'msg' => 'Cache cleared successfully.'], 200);
    }
    catch (\Throwable $th)
    {
        //throw $th;
        return response()->json(['message' => $th->getMessage()], 500);
    }
})->name('cache.clear');



Route::middleware(['auth', 'verified', 'setLocale'])->group(function ()
{

      // System Settings Routes
      Route::get('settings', [SettingController::class, 'settings'])->name('system-setting');
      Route::post('customize', [SettingController::class, 'customize'])->name('theme.customize')->middleware('can:theme-customization');
      Route::get('general-setting', [SettingController::class, 'generalSetting'])->name('general-setting')->middleware('can:general-setting');
      Route::post('general-setting', [SettingController::class, 'generalSettingStore'])->name('general-setting.store')->middleware('can:general-setting');
      Route::post('logo-upload', [SettingController::class, 'logoUpload'])->name('general-setting-logo.store')->middleware('can:general-setting');
      Route::post('favicon-upload', [SettingController::class, 'faviconUpload'])->name('general-setting-favicon.store')->middleware('can:general-setting');
      Route::get('email-setting', [SettingController::class, 'emailSetting'])->name('email-setting')->middleware('can:email-setting');
      Route::post('email-setting', [SettingController::class, 'emailSettingUpdate'])->name('email-setting.store')->middleware('can:email-setting');
      Route::get('pusher-setting', [SettingController::class, 'pusherSetting'])->name('pusher-setting')->middleware('can:pusher-setting');
      Route::post('pusher-setting', [SettingController::class, 'pusherSettingStore'])->name('pusher-setting.store')->middleware('can:pusher-setting');


    Route::middleware('role:Super Admin')->group(function ()
    {
        // Role Route
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/users', [RoleController::class, 'users'])->name('roles.users');
        Route::post('roles/user-remove', [RoleController::class, 'userRemove'])->name('roles.user.remove');
        Route::post('roles/user-add/{id}', [RoleController::class, 'userAdd'])->name('roles.user.add');
        Route::get('roles/{id}/permissions', [RoleController::class, 'rolePermission'])->name('roles.permissions');
        Route::post('roles/{id}/permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');

        // Permission Route
        Route::resource('permissions', PermissionController::class);
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Notifications
    Route::controller(NotificationController::class)->prefix('notifications/')->name('notify.')->group(function ()
    {
        Route::get('/', 'index')->name('index');
    });

    Route::resource('users', UserController::class)->except(['show']);

    Route::controller(ProfileController::class)->group(function ()
    {
        Route::get('profile', 'profile')->name('profile');
        Route::put('profile', 'profileUpdate')->name('profile.update');
        Route::put('password', 'passwordUpdate')->name('password.update');
    });
});
