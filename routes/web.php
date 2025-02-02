<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContentController;


Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');

Route::get('/main', function () {
    return view('main');
})->middleware('auth')->name('main');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ContentController::class, 'index'])->name('dashboard');
    Route::get('/explore', [ContentController::class, 'explore'])->name('explore');
    Route::get('/manage', [ContentController::class, 'manage'])->name('manage');
    Route::get('/pets', [ContentController::class, 'pets'])->name('pets');
    Route::get('/history', [ContentController::class, 'history'])->name('history');
    Route::get('/account', [ContentController::class, 'account'])->name('account');
    Route::get('/about', [ContentController::class, 'about'])->name('about');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes for loading content without layout
    Route::get('/content/dashboard', [ContentController::class, 'dashboardContent'])->name('content.dashboard');
    Route::get('/content/explore', [ContentController::class, 'exploreContent'])->name('content.explore');
    Route::get('/content/manage', [ContentController::class, 'manageContent'])->name('content.manage');
    Route::get('/content/pets', [ContentController::class, 'petsContent'])->name('content.pets');
    Route::get('/content/history', [ContentController::class, 'historyContent'])->name('content.history');
    Route::get('/content/account', [ContentController::class, 'accountContent'])->name('content.account');
    Route::get('/content/about', [ContentController::class, 'aboutContent'])->name('content.about');
});