<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// Me: This is where people edit their link profile
Route::get('/me', function () {
    return view('me');
})->middleware(['auth'])->name('me');

// To: This will be the page where people can view other people's profiles
Route::get('/to/{id}', function () {
    return view('to');
})->middleware(['auth'])->name('to');

// Settings: This is where people can edit their settings
Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth'])->name('settings');

require __DIR__.'/auth.php';
