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
use App\Http\Controllers\Admin\AdminPetsController;
use App\Http\Controllers\Admin\AdminAppointmentsController;
use App\Http\Controllers\Admin\AdminBoardingsController;
use App\Http\Controllers\Admin\AdminServicesController;
use App\Http\Controllers\Admin\AdminPaymentsController;
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
Route::middleware(['auth', 'redirect.admin'])->group(function () {  // Remove 'ajax.headers' from here
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
    // Dashboard routes
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/weekly-data', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getWeeklyServiceData'])
    ->name('admin.dashboard.weekly-data');

    // Users routes
    Route::get('/users/list', [AdminUsersController::class, 'getUsersList'])->name('admin.users.list');
    Route::get('/users/{userId}/pets', [AdminUsersController::class, 'getUserPets'])->name('admin.users.pets');
    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/users/data', [AdminController::class, 'getUsersData'])->name('admin.users.data');
    Route::post('/users/store', [AdminUsersController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}', [AdminUsersController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [AdminUsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

    // Appointments routes
    Route::get('/appointments', [AdminAppointmentsController::class, 'index'])->name('admin.appointments');
    Route::get('/upcoming-appointments/data', [AdminController::class, 'getUpcomingAppointmentsData'])->name('admin.upcoming-appointments.data');
    Route::get('/appointments/data', [AdminAppointmentsController::class, 'getAppointmentsData'])->name('admin.appointments.data');
    Route::post('/appointments/{id}/cancel', [AdminAppointmentsController::class, 'cancelAppointment'])->name('admin.appointments.cancel');
    Route::get('/appointments/available-times', [AdminAppointmentsController::class, 'getAvailableTimes'])->name('admin.appointments.available-times');
    Route::post('/appointments/store', [AdminAppointmentsController::class, 'store'])->name('admin.appointments.store');
    Route::get('/appointments/{id}', [AdminAppointmentsController::class, 'show'])->name('admin.appointments.show');
    Route::get('/appointments/{id}/edit', [AdminAppointmentsController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('/appointments/{id}', [AdminAppointmentsController::class, 'update'])->name('admin.appointments.update');
    Route::patch('/appointments/{id}/status', [AdminAppointmentsController::class, 'updateStatus'])->name('admin.appointments.update-status');

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

    // Payments
    Route::get('/payments', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'index'])->name('admin.payments');
    Route::get('/payments/data', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'getPaymentsData'])->name('admin.payments.data');
    Route::get('/payments/{id}', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'show'])->name('admin.payments.show');
    Route::put('/payments/{id}', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'update'])->name('admin.payments.update');
    Route::post('/payments/{id}/refund', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'markAsRefunded'])->name('admin.payments.refund');
    Route::post('/payments', [App\Http\Controllers\Admin\AdminPaymentsController::class, 'store'])->name('admin.payments.store');

    // Reports
    Route::get('/reports', [AdminReportsController::class, 'index'])->name('admin.reports');
    Route::get('/reports/data', [AdminReportsController::class, 'getLogsData'])->name('admin.reports.data');
    Route::get('/reports/{id}', [AdminReportsController::class, 'show'])->name('admin.reports.show');
    Route::post('/reports/restore', [AdminReportsController::class, 'restore'])->name('admin.reports.restore');

    // Admin Account Routes
    Route::get('/account', [App\Http\Controllers\Admin\AdminAccountController::class, 'index'])->name('admin.account');
    Route::put('/account/update', [App\Http\Controllers\Admin\AdminAccountController::class, 'update'])->name('admin.account.update');
    Route::get('/account/logout-devices', [App\Http\Controllers\Admin\AdminAccountController::class, 'logoutFromAllDevices'])->name('admin.logout.devices');

    // Data for Pet Modal
    Route::post('/pets/store', [App\Http\Controllers\Admin\AdminPetsController::class, 'store'])->name('admin.pets.store');
    Route::get('/pets', [AdminPetsController::class, 'index'])->name('admin.pets');
    Route::get('/pets/{id}', [AdminPetsController::class, 'showPet'])->name('admin.pets.show');
    Route::get('/{id}/edit', [AdminPetsController::class, 'edit'])->name('admin.pets.edit');
    Route::put('/pets/{id}', [AdminPetsController::class, 'update'])->name('admin.pets.update');
    Route::delete('/pets/{id}', [AdminPetsController::class, 'destroy'])->name('admin.pets.destroy');

    // Data for Boarding Modal
    Route::post('/boarding/store', [\App\Http\Controllers\Admin\AdminBoardingsController::class, 'store'])
    ->name('admin.boarding.store');
});