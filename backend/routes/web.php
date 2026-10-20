<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileVerificationController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MatchesInterestsController;

use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\VendorAssignmentReportController;
use App\Http\Controllers\Admin\MatrimonyMasterController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public / Authentication Routes
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

Route::middleware(['auth:admin', 'admin.permissions'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/change-password', [AdminAuthController::class, 'showChangePasswordForm'])
            ->name('change.password');
        Route::post('/change-password', [AdminAuthController::class, 'updatePassword'])
            ->name('change.password.update');

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

Route::get('/matches-interests', [
    MatchesInterestsController::class,
    'index'
])->name('admin.matches-interests');
        
Route::get('/vendor-assignment-report', [
    VendorAssignmentReportController::class,
    'index'
])->name('admin.vendor-assignments.index');


Route::get('/matches-interests', [
    MatchesInterestsController::class,
    'index'
])->name('admin.matches-interests');

Route::get('/membership', [
    MembershipController::class,
    'index'
])->name('admin.membership');

Route::post('/membership/plans', [
    MembershipController::class,
    'storePlan'
])->name('admin.membership.plans.store');

Route::put('/membership/plans/{id}', [
    MembershipController::class,
    'updatePlan'
])->name('admin.membership.plans.update');

Route::get('/membership/export', [
    MembershipController::class,
    'export'
])->name('admin.membership.export');

        Route::get('/matrimonymasterdata', [MatrimonyMasterController::class, 'index'])
            ->name('admin.matrimonymasterdata');
        Route::get('/matrimonymasterdata/export', [MatrimonyMasterController::class, 'export'])
            ->name('admin.matrimonymasterdata.export');
        Route::post('/matrimonymasterdata/bulk-review', [MatrimonyMasterController::class, 'bulkReview'])
            ->name('admin.matrimonymasterdata.bulk-review');

        Route::get('/report', [ReportController::class, 'index'])->name('admin.report');

        Route::get('/setting', [SettingsController::class, 'index'])->name('admin.setting');
        Route::post('/setting', [SettingsController::class, 'update'])->name('admin.setting.update');
        Route::post('/setting/backup', [SettingsController::class, 'backup'])->name('admin.setting.backup');
        Route::post('/setting/restore', [SettingsController::class, 'restore'])->name('admin.setting.restore');
        Route::post('/setting/admins', [SettingsController::class, 'adminStore'])->name('admin.setting.admins.store');
        Route::put('/setting/admins/{id}', [SettingsController::class, 'adminUpdate'])->name('admin.setting.admins.update');
        Route::delete('/setting/admins/{id}', [SettingsController::class, 'adminDestroy'])->name('admin.setting.admins.destroy');
        Route::get('/setting/assets/{type}', [SettingsController::class, 'asset'])
            ->whereIn('type', ['logo', 'favicon'])
            ->name('admin.setting.asset');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

       // CMS & Communication - Homepage Banner
Route::get('/cms-communication', [
    CmsController::class,
    'index'
])->name('admin.cms-communication');

Route::post('/cms-communication/banner', [
    CmsController::class,
    'updateBanner'
])->name('cms.banner.update');
    });
});
