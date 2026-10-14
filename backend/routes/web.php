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
    return view('dashboard');
});
Route::get('/management', function () {
    return view('management');
});
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