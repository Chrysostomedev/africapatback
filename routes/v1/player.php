<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\RewardController;
use App\Http\Controllers\Api\CivilizationController;
use App\Http\Controllers\Api\WavePaymentController;
use App\Http\Controllers\Api\Player\GameController;

/*
|--------------------------------------------------------------------------
| Player Routes (V1)
|--------------------------------------------------------------------------
| Ces routes sont destinées aux joueurs et sont protégées par Sanctum.
*/

Route::prefix('player')->middleware('auth:sanctum')->group(function () {
    
    // Profil & Statistiques
    Route::get('/profile', [PlayerController::class, 'profile']);
    Route::get('/inventory/nfts', [PlayerController::class, 'nfts']);
    
    // Culture & Civilisations
    Route::get('/civilizations', [CivilizationController::class, 'index']);
    Route::get('/civilizations/{id}', [CivilizationController::class, 'show']);
    
    // Jeux & Activités
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::post('/games/marelle/start', [GameController::class, 'startMarelle']);
    Route::post('/games/genie-herbe/start', [GameController::class, 'startGenieMatch']);
    Route::post('/games/fox-wheel/spin', [GameController::class, 'spinWheel']);
    
    Route::post('/sessions/{session_id}/submit', [QuizController::class, 'submitResults']);
    
    // Récompenses & Blockchain
    Route::get('/rewards/pending', [RewardController::class, 'pending']);
    Route::post('/rewards/claim', [RewardController::class, 'claim']);
    
    // Paiements Wave
    Route::post('/payments/wave/deposit', [WavePaymentController::class, 'deposit']);

});

// Auth Public (Inscription/Connexion)
Route::post('/auth/wallet', [AuthController::class, 'connectWallet']);
Route::post('/auth/passkey/login', [AuthController::class, 'loginPasskey']);
