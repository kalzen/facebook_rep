<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/getdata', [DataController::class, 'getData'])->name('getdata');
Route::get('/response', [DataController::class, 'getAllData'])->name('googlespreadsheet');
Route::post('/submission', [DataController::class, 'getData'])->name('submission');
Route::get('/showsession', [DataController::class, 'showSession'])->name('showsession');
// Add the new route
Route::get('/get-language', [HomeController::class, 'getLanguage']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/data/{id}', [AdminController::class, 'delete'])->name('admin.data.delete');
    
    // Add new business routes
    Route::get('/business', [AdminController::class, 'business'])->name('admin.business');
    Route::post('/business', [AdminController::class, 'storeBusiness'])->name('admin.business.store');
    Route::delete('/business/{id}', [AdminController::class, 'deleteBusiness'])->name('admin.business.delete');
    Route::post('/business/update-telebot', [AdminController::class, 'updateTelebot'])->name('admin.business.updateTelebot');
    Route::post('/admin/business/update-telebot', [AdminController::class, 'updateTelebot'])
        ->name('admin.business.updateTelebot');
});