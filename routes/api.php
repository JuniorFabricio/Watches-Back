<?php

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\WatchController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas (sin autenticación)
Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

// Rutas protegidas por JWT Middleware
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [JWTAuthController::class, 'getUser']);
    Route::post('logout', [JWTAuthController::class, 'logout']);

    // CRUD de relojes (requieren autenticación)
    Route::get('/watches', [WatchController::class, 'getAll']);
    Route::get('/watches/{price}', [WatchController::class, 'getWatchByPrice']);
    Route::get('/watch/{id}', [WatchController::class, 'get']);
    Route::post('/watch', [WatchController::class, 'create']);
    Route::delete('/watchdelete/{id}', [WatchController::class, 'delete']);
    Route::put('/watch/{id}', [WatchController::class, 'update']);
});
