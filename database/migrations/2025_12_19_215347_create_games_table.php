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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('home_team'); // Ev sahibi takım
            $table->string('away_team'); // Deplasman takımı
            $table->date('match_date'); // Maç tarihi
            $table->time('match_time')->nullable(); // Maç saati
            $table->integer('home_score')->nullable(); // Ev sahibi takım skoru
            $table->integer('away_score')->nullable(); // Deplasman takımı skoru
            $table->enum('status', ['upcoming', 'live', 'finished'])->default('upcoming'); // Durum: yakında, canlı, bitti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
