<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogMahalController;
use App\Http\Controllers\KatalogMurahController;
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



// Katalog Murah Controller
Route::resource('murahs', KatalogMurahController::class);
