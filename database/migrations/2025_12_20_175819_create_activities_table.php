<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     * Activities tablosu - Polymorphic ilişki ile hem Author hem Category'ye bağlanabilir
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Etkinlik başlığı
            $table->text('description')->nullable(); // Kısa açıklama
            $table->string('image')->nullable(); // Etkinlik resmi
            $table->integer('order')->default(0); // Sıralama için
            // Polymorphic ilişki - hem Author hem Category'ye bağlanabilir
            $table->morphs('activityable'); // activityable_id ve activityable_type kolonları oluşturur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
