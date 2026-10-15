<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/management', function () {
    return view('admin.management');
});
Route::get('/profile', function () {
    return view('admin.profile');
});
Route::get('/vendors', function () {
    return view('admin.vendors');
});
Route::get('/matches-interests', function () {
    return view('admin.matches-interests');
});
Route::get('/membership', function () {
    return view('admin.membership');
});
Route::get('/matrimonymasterdata', function () {
    return view('admin.matrimonymasterdata');
});

Route::get('/report', function () {
    return view('admin.report');
});

Route::get('/setting', function () {
    return view('admin.setting');
});