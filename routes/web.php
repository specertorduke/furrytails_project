<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;


Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/main', function () {
    return view('main');
})->middleware('auth')->name('main');

Route::get('/', function () {
    return view('home');
})->name('home');

//content routes
Route::middleware('auth')->group(function () {
    Route::get('/content/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/content/explore', [ContentController::class, 'exploreContent'])->name('content.explore');
    Route::get('/content/manage', [ContentController::class, 'manageContent'])->name('content.manage');
    Route::get('/content/pets', [ContentController::class, 'petsContent'])->name('content.pets');
    Route::get('/content/history', [ContentController::class, 'historyContent'])->name('content.history');
    Route::get('/content/account', [ContentController::class, 'accountContent'])->name('content.account');
    Route::get('/content/about', [ContentController::class, 'aboutContent'])->name('content.about');
});

