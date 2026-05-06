<?php

namespace App\Http\Controllers\Api\Player;

use App\Http\Controllers\Controller;
use App\Services\MarelleService;
use App\Services\GenieHerbeService;
use App\Services\FoxWheelService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur GameController (Joueurs)
 * 
 * Point d'entrée pour toutes les activités de jeu.
 */
class GameController extends Controller
{
    use ApiResponseTrait;

    protected $marelleService;
    protected $genieHerbeService;
    protected $foxWheelService;

    public function __construct(
        MarelleService $marelle,
        GenieHerbeService $genie,
        FoxWheelService $wheel
    ) {
        $this->marelleService = $marelle;
        $this->genieHerbeService = $genie;
        $this->foxWheelService = $wheel;
    }

    /**
     * Lancer la Marelle
     */
    public function startMarelle(Request $request)
    {
        $session = $this->marelleService->initializeGame($request->user()->id);
        return $this->success($session, 'Partie de Marelle initialisée.');
    }

    /**
     * Lancer un match Génie en Herbe
     */
    public function startGenieMatch(Request $request)
    {
        $request->validate(['civilization_id' => 'required|exists:civilizations,id']);
        $match = $this->genieHerbeService->startMatch($request->civilization_id);
        return $this->success($match, 'Match de Génie en Herbe prêt.');
    }

    /**
     * Tourner la Roue (Renard Passe Passe)
     */
    public function spinWheel(Request $request)
    {
        $result = $this->foxWheelService->spin($request->user()->id);
        return $this->success($result, 'La roue a tourné !');
    }
}
