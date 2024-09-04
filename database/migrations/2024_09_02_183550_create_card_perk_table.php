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
        Schema::create('card_perk', function (Blueprint $table) {
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('perk_id');

            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->foreign('perk_id')->references('id')->on('perks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_perk');
    }
};
