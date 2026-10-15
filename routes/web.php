<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
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