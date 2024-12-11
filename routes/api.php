<?php
use App\Http\Controllers\DataController;

Route::get('/data/all', [DataController::class, 'getAllData']);