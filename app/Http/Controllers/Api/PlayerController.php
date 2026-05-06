<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

/**
 * Contrôleur PlayerController
 * 
 * Gère le profil, l'inventaire NFT et les stats du joueur.
 */
class PlayerController extends Controller
{
    use ApiResponseTrait;

    /**
     * Voir son propre profil.
     */
    public function profile(Request $request)
    {
        $user = $request->user()->load(['playerProfile', 'commune.region']);
        return $this->success($user, 'Profil récupéré.');
    }

    /**
     * Voir son inventaire de NFTs.
     */
    public function nfts(Request $request)
    {
        $nfts = $request->user()->nfts;
        return $this->success($nfts, 'Inventaire NFT récupéré.');
    }
}
