<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Activities tablosunda image alanını kaldırıp images JSON alanı ekler
     */
    public function up(): void
    {
        // Önce images kolonunu ekle
        Schema::table('activities', function (Blueprint $table) {
            $table->json('images')->nullable()->after('description');
        });
        
        // Mevcut image verilerini images array'ine çevir
        $activities = DB::table('activities')->whereNotNull('image')->get();
        
        foreach ($activities as $activity) {
            if ($activity->image) {
                DB::table('activities')
                    ->where('id', $activity->id)
                    ->update(['images' => json_encode([$activity->image])]);
            }
        }
        
        // image kolonunu kaldır
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     * images JSON alanını kaldırıp image alanını geri ekler
     */
    public function down(): void
    {
        // Önce image kolonunu ekle
        Schema::table('activities', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
        });
        
        // images'dan ilk resmi alıp image olarak kaydet
        $activities = DB::table('activities')->whereNotNull('images')->get();
        
        foreach ($activities as $activity) {
            $images = json_decode($activity->images, true);
            if (is_array($images) && count($images) > 0) {
                DB::table('activities')
                    ->where('id', $activity->id)
                    ->update(['image' => $images[0]]);
            }
        }
        
        // images kolonunu kaldır
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
