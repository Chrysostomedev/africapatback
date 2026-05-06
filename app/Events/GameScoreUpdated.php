<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Événement GameScoreUpdated
 * 
 * Diffuse le score en temps réel via Laravel Reverb.
 * Permet de mettre à jour le leaderboard Next.js instantanément.
 */
class GameScoreUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $newScore;

    /**
     * Créer une nouvelle instance d'événement.
     */
    public function __construct($userId, $newScore)
    {
        $this->userId = $userId;
        $this->newScore = $newScore;
    }

    /**
     * Sur quel canal l'événement doit être diffusé.
     */
    public function broadcastOn(): array
    {
        // On diffuse sur un canal public pour le leaderboard global
        return [
            new Channel('leaderboard'),
            new PrivateChannel('user.' . $this->userId), // Et en privé pour l'utilisateur
        ];
    }

    /**
     * Nom de l'événement diffusé.
     */
    public function broadcastAs(): string
    {
        return 'score.updated';
    }
}
