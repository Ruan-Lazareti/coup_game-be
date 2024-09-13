<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_card', function (Blueprint $table) {
            $table->id();
						$table->foreignId('player_id')->constrained('players')->onDelete('cascade');
						$table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
						$table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_card');
    }
};
