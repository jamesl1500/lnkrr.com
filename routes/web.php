<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MeController;
use App\Http\Controllers\API\LinksController;
use App\Http\Controllers\ToController;

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
Route::get('/to/{username}',[ToController::class, "index"])->middleware(['auth'])->name('to');

// Settings: This is where people can edit their settings
Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth'])->name('settings');

// Settings: This is where people can edit their settings
Route::post('/me/editProfileForm_BasicInfo', [MeController::class, "update"])->middleware(['auth'])->name('me.editProfileForm_BasicInfo');

// Links: Save new link
Route::post('/me/editProfileForm_Links', [LinksController::class, "store"])->middleware(['auth'])->name('links.addLink');
require __DIR__.'/auth.php';

// Link resource
Route::resource('LinksModel', LinksController::class)->middleware(['auth']);

// Link: Delete link
Route::delete('/me/editProfileForm_Links/delete/{id}', [LinksController::class, "destroy"])->middleware(['auth'])->name('links.destroy');

// Link: Edit link
Route::post('/me/editProfileForm_Links/update/{id}', [LinksController::class, "update"])->middleware(['auth'])->name('links.update');