<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\CivilizationController;

/*
|--------------------------------------------------------------------------
| Admin Routes (V1)
|--------------------------------------------------------------------------
| Ces routes sont destinées à l'administration d'AKWABA.
*/

Route::prefix('admin')->group(function () {

    // Auth Admin (Email/Password)
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Routes protégées Admin
    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index']);
        
        // Gestion du contenu
        Route::apiResource('civilizations', CivilizationController::class)->except(['index', 'show']);
        
        // Gestion des utilisateurs & transactions
        Route::get('/users', [DashboardController::class, 'users']);
        Route::get('/transactions', [DashboardController::class, 'transactions']);
        
    });

});
