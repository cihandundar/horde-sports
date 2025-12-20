<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Haber onay sistemi için gerekli alanları ekle
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Kullanıcı ID - Haberi ekleyen kullanıcı (nullable çünkü eski haberler için null olabilir)
            $table->foreignId('user_id')->nullable()->after('category_id')->constrained('users')->onDelete('cascade');
            // Onay durumu - Admin onayı olmadan yayınlanmaz (default false)
            $table->boolean('is_approved')->default(false)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     * Eklenen alanları geri al
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'is_approved']);
        });
    }
};
