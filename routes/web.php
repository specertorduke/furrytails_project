<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HistoryController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminAppointmentsController;
use App\Http\Controllers\Admin\AdminBoardingsController;
use App\Http\Controllers\Admin\AdminServicesController;
use App\Http\Controllers\Admin\AdminReportsController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [LoginController::class, 'login' ])->name('login.submit');

Route::get('/signup', function () { return view('signup'); })->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/main', function () { return view('main'); })->middleware('auth')->name('main');

Route::get('/', function () { return view('home'); })->name('home');

//content routes
Route::middleware(['auth'])->group(function () {  // Remove 'ajax.headers' from here
    Route::get('/content', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/content/explore', [ContentController::class, 'exploreContent'])->name('content.explore');
    Route::get('/content/manage', [ContentController::class, 'manageContent'])->name('content.manage');
    Route::get('/content/pets', [PetController::class, 'index'])->name('content.pets');
    Route::get('/content/history', [HistoryController::class, 'index'])->name('content.history');    
    Route::get('/content/account', [AccountController::class, 'index'])->name('content.account');
    Route::get('/content/about', [ContentController::class, 'aboutContent'])->name('content.about');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');

    // Manage Page routes
    Route::get('/manage/fetch-appointments', [ManageController::class, 'fetchAppointments'])->name('manage.appointments');
    Route::get('/manage/fetch-boardings', [ManageController::class, 'fetchBoardings'])->name('manage.boardings');

    // Pet Page routes
    Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');

    // CRUD routes for appointments
    Route::get('/appointments/{id}', [ManageController::class, 'showAppointment']);
    Route::put('/appointments/{id}', [ManageController::class, 'updateAppointment']);
    Route::delete('/appointments/{id}', [ManageController::class, 'deleteAppointment']);
    
    // CRUD routes for boardings
    Route::get('/boardings/{id}', [ManageController::class, 'showBoarding']);
    Route::put('/boardings/{id}', [ManageController::class, 'updateBoarding']);
    Route::delete('/boardings/{id}', [ManageController::class, 'deleteBoarding']);
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users routes
    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/users/data', [AdminController::class, 'getUsersData'])->name('admin.users.data');

    // Appointments routes
    Route::get('/appointments', [AdminAppointmentsController::class, 'index'])->name('admin.appointments');
    Route::get('/upcoming-appointments/data', [AdminController::class, 'getUpcomingAppointmentsData'])->name('admin.upcoming-appointments.data');
    Route::get('/appointments/data', [AdminAppointmentsController::class, 'getAppointmentsData'])->name('admin.appointments.data');
    Route::post('/appointments/{id}/cancel', [AdminAppointmentsController::class, 'cancelAppointment']);
    
    // Boardings routes
    Route::get('/boardings', [AdminBoardingsController::class, 'index'])->name('admin.boardings');
    Route::get('/ongoing-boardings/data', [AdminController::class, 'getOngoingBoardingsData'])->name('admin.ongoing-boardings.data');
    Route::get('boardings/ongoing-boardings/data', [AdminController::class, 'getOngoingBoardingsData'])->name('boardings.ongoing-boardings.data');
    Route::get('/boardings/data', [AdminBoardingsController::class, 'getBoardingsData'])->name('admin.boardings.data');
    Route::post('/boardings/{id}/cancel', [AdminBoardingsController::class, 'cancelBoarding']);

    // Services routes
    Route::get('/services', [AdminServicesController::class, 'index'])->name('admin.services');
    Route::get('/services/list', [AdminServicesController::class, 'getServicesList'])->name('admin.services.list');
    Route::post('/services/{id}/toggle-status', [AdminServicesController::class, 'toggleStatus'])->name('admin.services.toggle-status');
    Route::delete('/services/{id}', [AdminServicesController::class, 'destroy'])->name('admin.services.destroy');
    
    // Settings
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');

    // Reports and logout
    Route::get('/reports', [AdminReportsController::class, 'index'])->name('admin.reports');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

});