<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/getdata', [DataController::class, 'getData'])->name('getdata');
Route::get('/response', [DataController::class, 'getAllData'])->name('googlespreadsheet');
Route::post('/submission', [DataController::class, 'getData'])->name('submission');