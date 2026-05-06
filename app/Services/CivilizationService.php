<?php

namespace App\Services;

use App\Models\Civilization;
use Illuminate\Support\Str;

/**
 * Service CivilizationService
 * 
 * Centralise toute la logique métier liée aux civilisations.
 * Utilise les UUIDs pour la compatibilité avec les mock data.
 */
class CivilizationService
{
    /**
     * Récupérer toutes les civilisations actives.
     */
    public function getAllActive()
    {
        return Civilization::where('is_active', true)->get();
    }

    /**
     * Créer ou mettre à jour une civilisation depuis les mock data.
     */
    public function syncFromMock(array $data)
    {
        return Civilization::updateOrCreate(
            ['id' => $data['id']],
            [
                'name' => $data['name'],
                'period' => $data['period'],
                'region_name' => $data['region'],
                'description' => $data['description'],
                'achievements' => $data['achievements'],
                'color' => $data['color'],
                'coordinates' => $data['coordinates'],
            ]
        );
    }

    /**
     * Supprimer une civilisation.
     */
    public function delete(string $id)
    {
        $civ = Civilization::findOrFail($id);
        return $civ->delete();
    }
}
