<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileVerificationController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Guest / Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [AdminAuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AdminAuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AdminAuthController::class, 'resetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(app()->environment('local') ? [] : ['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/change-password', [AdminAuthController::class, 'showChangePasswordForm'])->name('change.password');
        Route::post('/change-password', [AdminAuthController::class, 'updatePassword'])->name('change.password.update');

        // Admin Account Management
        Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');

        // User Management
        Route::get('/management', [UserController::class, 'userindex'])->name('users.index');
        Route::post('/management/store', [UserController::class, 'userstore'])->name('users.store');
        Route::put('/management/update/{id}', [UserController::class, 'userupdate'])->name('users.update');
        Route::delete('/management/delete/{id}', [UserController::class, 'userdestroy'])->name('users.destroy');
        Route::get('/management/export', [UserController::class, 'userexport'])->name('users.export');

        // Profile Verification
        Route::get('/profile', [ProfileVerificationController::class, 'index'])->name('admin.profile-verification.index');
        Route::post('/profile/{id}/review', [ProfileVerificationController::class, 'review'])
            ->whereNumber('id')
            ->name('admin.profile-verification.review');

        // Vendor Management
        Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
        Route::post('/vendors', [VendorController::class, 'store'])->name('admin.vendors.store');
        Route::post('/vendors/{vendor}/assign-profile', [VendorController::class, 'assignProfile'])->name('admin.vendors.assign-profile');
        Route::get('/vendor-assignments', [VendorController::class, 'assignments'])->name('admin.vendor-assignments.index');

        Route::get('/matches-interests', function () {
            return view('admin.matches-interests');
        })->name('admin.matches-interests');

        Route::get('/membership', function () {
            return view('admin.membership');
        })->name('admin.membership');

        Route::get('/matrimonymasterdata', function () {
            return view('admin.matrimonymasterdata');
        })->name('admin.matrimonymasterdata');

        Route::get('/report', function () {
            return view('admin.report');
        })->name('admin.report');

        Route::get('/cms-communication', function () {
            return view('admin.cms-communication');
        })->name('admin.cms-communication');

        /*
        |--------------------------------------------------------------------------
        | Settings Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('settings')->name('admin.settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::post('/update', [SettingController::class, 'update'])->name('update');
            Route::post('/users/store', [SettingController::class, 'storeUser'])->name('users.store');
            Route::delete('/users/{id}', [SettingController::class, 'deleteUser'])->name('users.delete');
            Route::post('/permissions/update', [SettingController::class, 'updatePermissions'])->name('permissions.update');
        });

        // Redirects for sidebar compatibility (/admin/setting or /admin/settings)
        Route::get('/setting', function () {
            return redirect()->route('admin.settings.index');
        })->name('admin.setting');
    });
});