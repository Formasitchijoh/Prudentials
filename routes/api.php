<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\Projects\Controllers\ProjectController;
use App\Domains\Projects\Controllers\TaskController;
use App\Http\Controllers\TenantController;
use App\Domains\Projects\Controllers\ProjectMemberController;

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', fn(Request $request) => $request->user());
    Route::get('/auth_user',[ AuthController::class, 'user']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']); // ← MOVE HERE

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);       // ← MOVE HERE

    Route::get('/tenant', [TenantController::class, 'index']);
    Route::post('/tenant', [TenantController::class, 'store']);

    Route::prefix('project')->group(function () {
        Route::get('/members', [ProjectMemberController::class, 'index']);
        Route::post('/member', [ProjectMemberController::class, 'store']);

    });
});
