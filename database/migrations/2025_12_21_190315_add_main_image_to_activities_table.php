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
     * Activities tablosuna main_image alanı ekler (ana görsel için)
     */
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('main_image')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     * main_image alanını kaldırır
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('main_image');
        });
    }
};
