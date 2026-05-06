<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blockchain_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tx_hash')->unique()->nullable();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Reward_Distribution', 'NFT_Mint', 'Token_Burn']);
            $table->enum('status', ['Pending', 'Confirmed', 'Failed'])->default('Pending');
            $table->decimal('gas_used', 18, 8)->nullable();
            $table->bigInteger('block_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blockchain_transactions');
    }
};
