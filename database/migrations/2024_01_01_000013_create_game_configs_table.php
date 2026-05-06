<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour la table 'game_configs'
 * 
 * Permet à l'administrateur de modifier les paramètres des jeux 
 * sans toucher au code source.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_configs', function (Blueprint $table) {
            $table->id();
            $table->string('game_key')->unique(); // ex: marelle, fox_wheel, genie_herbe
            $table->json('settings');             // Paramètres JSON
            $table->boolean('is_maintenance')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_configs');
    }
};
