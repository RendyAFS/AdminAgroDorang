<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogMahalController;
use App\Http\Controllers\KatalogMurahController;
use App\Http\Controllers\UserMahal;
use App\Http\Controllers\UserMurah;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard Controller
Route::resource('dasboards', DashboardController::class);



// Katalog Mahal Controller
Route::resource('mahals', KatalogMahalController::class);
Route::get('getkatalogmahal', [KatalogMahalController::class,'getData'])->name('mahals.getData');





// Katalog Murah Controller
Route::resource('murahs', KatalogMurahController::class);
Route::get('getkatalogmurah', [KatalogMurahController::class,'getData'])->name('murahs.getData');




// Katalog User Murah Controller
Route::resource('katalog1', UserMahal::class);


// Katalog User Murah Controller
Route::resource('katalog2', UserMurah::class);
