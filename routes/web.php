<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Projects\Controllers\ProjectController;

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/project',[ ProjectController::class, 'index']);

