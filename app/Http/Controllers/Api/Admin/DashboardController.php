<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BlockchainTransaction;
use App\Models\GameSession;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur DashboardController
 * 
 * Statistiques globales pour l'administration.
 */
class DashboardController extends Controller
{
    use ApiResponseTrait;

    /**
     * Résumé du Dashboard
     */
    public function index()
    {
        $stats = [
            'total_players' => User::count(),
            'total_games_played' => GameSession::count(),
            'total_blockchain_tx' => BlockchainTransaction::count(),
            'active_sessions_today' => GameSession::whereDate('created_at', today())->count(),
        ];

        return $this->success($stats, 'Statistiques du dashboard récupérées.');
    }

    /**
     * Liste des utilisateurs (avec pagination)
     */
    public function users()
    {
        $users = User::with('playerProfile')->paginate(20);
        return $this->success($users, 'Liste des joueurs récupérée.');
    }

    /**
     * Liste des transactions
     */
    public function transactions()
    {
        $transactions = BlockchainTransaction::latest()->paginate(50);
        return $this->success($transactions, 'Liste des transactions récupérée.');
    }
}
