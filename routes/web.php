<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/getdata', [DataController::class, 'getData'])->name('getdata');
Route::post('/submission', [DataController::class, 'getData'])->name('submission');