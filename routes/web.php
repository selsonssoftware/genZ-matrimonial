<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\AdminController;




Route::middleware('auth')->group(function () {
    Route::get('/admins', [AdminController::class, 'index'])
        ->name('admins.index');

    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])
        ->name('admins.edit');

    Route::put('/admins/{id}', [AdminController::class, 'update'])
        ->name('admins.update');

    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])
        ->name('admins.destroy');
});


// Admin Login & Reset Routes
Route::get('/', [AdminAuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AdminAuthController::class, 'login'])
    ->name('login.submit');

Route::get('/forgot-password', [AdminAuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AdminAuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AdminAuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AdminAuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/change-password', [AdminAuthController::class, 'showChangePasswordForm'])->name('change.password');
    Route::post('/change-password', [AdminAuthController::class, 'updatePassword'])->name('change.password.update');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});


// Management & User CRUD Routes
Route::get('/management', [UserController::class, 'userindex'])->name('users.index');
Route::post('/management/store', [UserController::class, 'userstore'])->name('users.store');
Route::put('/management/update/{id}', [UserController::class, 'userupdate'])->name('users.update');
Route::delete('/management/delete/{id}', [UserController::class, 'userdestroy'])->name('users.destroy');
Route::get('/management/export', [UserController::class, 'userexport'])->name('users.export');

// Migilina pages
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/vendors', function () {
    return view('vendors');
});
Route::get('/matches-interests', function () {
    return view('matches-interests');
});
Route::get('/membership', function () {
    return view('membership');
});
Route::get('/matrimonymasterdata', function () {
    return view('matrimonymasterdata');
});
Route::get('/cms-communication', function () {
    return view('cms-communication');
});
Route::get('/settings', function () {
    return view('settings');
});