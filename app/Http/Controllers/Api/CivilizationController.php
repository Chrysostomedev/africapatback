<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CivilizationService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur CivilizationController (Admin & Public)
 * 
 * Gère les Civilisations avec une structure propre (Services + Traits).
 */
class CivilizationController extends Controller
{
    use ApiResponseTrait;

    protected $civilizationService;

    public function __construct(CivilizationService $service)
    {
        $this->civilizationService = $service;
    }

    /**
     * Liste toutes les civilisations (Public)
     */
    public function index()
    {
        $civilizations = $this->civilizationService->getAllActive();
        return $this->success($civilizations, 'Civilisations récupérées avec succès.');
    }

    /**
     * Création/Sync (Admin)
     */
    public function store(Request $request)
    {
        // On pourrait utiliser une FormRequest ici
        $civ = $this->civilizationService->syncFromMock($request->all());
        return $this->success($civ, 'Civilisation créée ou mise à jour.', 201);
    }

    /**
     * Suppression (Admin)
     */
    public function destroy(string $id)
    {
        $this->civilizationService->delete($id);
        return $this->success(null, 'Civilisation supprimée avec succès.');
    }
}
