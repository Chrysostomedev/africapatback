<?php

namespace App\Services;

use App\Models\Nft;
use App\Models\User;

/**
 * Service NftService
 * 
 * Gère le catalogue NFT et l'inventaire des joueurs.
 * Prépare l'interaction avec le contrat ERC-1155.
 */
class NftService
{
    protected $blockchain;

    public function __construct(BlockchainService $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    /**
     * Acheter un NFT avec le solde interne (Tokens $AKWABA).
     */
    public function buyNft(string $userId, string $nftId)
    {
        $user = User::findOrFail($userId);
        $nft = Nft::findOrFail($nftId);

        // 1. Vérifier le solde
        // 2. Déduire le montant
        // 3. Déclencher le minting sur Polygon via BlockchainService
        $txHash = $this->blockchain->mintNft($user->wallet_address, $nft->token_id);

        // 4. Mettre à jour l'inventaire local
        $user->nfts()->attach($nft->id, ['quantity' => 1]);

        return [
            'status' => 'success',
            'tx_hash' => $txHash,
            'nft' => $nft
        ];
    }
}
