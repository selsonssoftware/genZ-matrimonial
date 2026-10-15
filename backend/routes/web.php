<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileVerificationController;
use App\Http\Controllers\Admin\VendorController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Management
    Route::get('/management', function () {
        return view('admin.management');
    })->name('management');

    // Profile Verification
    Route::get('/profile', [
        ProfileVerificationController::class,
        'index'
    ])->name('profile-verification.index');

    Route::post('/profile/{id}/review', [
        ProfileVerificationController::class,
        'review'
    ])->whereNumber('id')
      ->name('profile-verification.review');

    // Vendor Management
    Route::get('/vendors', [
        VendorController::class,
        'index'
    ])->name('vendors.index');

    Route::post('/vendors', [
        VendorController::class,
        'store'
    ])->name('vendors.store');

    Route::post('/vendors/{vendor}/assign-profile', [
        VendorController::class,
        'assignProfile'
    ])->name('vendors.assign-profile');

    
// Vendor Assignment Report
Route::get('/vendor-assignments', [
    VendorController::class,
    'assignments'
])->name('vendor-assignments.index');

    // Other Admin Pages
    Route::get('/matches-interests', function () {
        return view('admin.matches-interests');
    })->name('matches-interests');

    Route::get('/membership', function () {
        return view('admin.membership');
    })->name('membership');

    Route::get('/report', function () {
        return view('admin.report');
    })->name('report');

    Route::get('/setting', function () {
        return view('admin.setting');
    })->name('setting');

    Route::get('/matrimonymasterdata', function () {
        return view('admin.matrimonymasterdata');
    })->name('matrimonymasterdata');

});
