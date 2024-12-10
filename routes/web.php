<?php
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::any('/getdata', [App\Http\Controllers\DataController::class, 'getData'])->name('getdata');