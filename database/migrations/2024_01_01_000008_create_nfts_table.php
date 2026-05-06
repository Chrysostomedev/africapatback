<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nfts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('token_id')->unique();
            $table->string('name');
            $table->string('metadata_uri');
            $table->decimal('price_akwaba', 18, 8);
            $table->integer('supply_total');
            $table->enum('rarity', ['Common', 'Rare', 'Epic', 'Legendary']);
            $table->timestamps();
        });

        Schema::create('user_nfts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('nft_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_nfts');
        Schema::dropIfExists('nfts');
    }
};
