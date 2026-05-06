<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour les Civilisations et Régions (V2 - Alignée sur les Mock Data)
 * 
 * Basée sur les structures exportées du front-end Next.js.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Table des Régions (Simplifiée)
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Table des Civilisations (Structure complète)
        Schema::create('civilizations', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Ex: civ_nubia
            $table->string('name');
            $table->string('period')->nullable();
            $table->string('region_name')->nullable(); // Correspond au champ 'region' des mock data
            $table->text('description')->nullable();
            $table->json('achievements')->nullable(); // Liste des exploits
            $table->string('color')->nullable();      // Code couleur HEX (ex: #D4A843)
            $table->json('coordinates')->nullable();  // [lat, lng]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('civilizations');
        Schema::dropIfExists('regions');
    }
};
