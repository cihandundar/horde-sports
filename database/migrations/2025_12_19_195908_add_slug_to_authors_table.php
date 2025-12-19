<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Authors tablosuna slug kolonu ekler - SEO-friendly URL'ler için
     */
    public function up(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            // Slug kolonu ekle - unique ve nullable (mevcut kayıtlar için)
            $table->string('slug')->unique()->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     * Slug kolonunu kaldırır
     */
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
