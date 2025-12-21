<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Activities tablosuna slug kolonu ekler
     */
    public function up(): void
    {
        // Slug kolonunu kontrol et - eğer yoksa ekle
        if (!Schema::hasColumn('activities', 'slug')) {
            Schema::table('activities', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }
        
        // Mevcut activities için slug oluştur (slug yoksa veya null ise)
        $activities = DB::table('activities')->where(function($query) {
            $query->whereNull('slug')->orWhere('slug', '');
        })->get();
        
        foreach ($activities as $activity) {
            $baseSlug = Str::slug($activity->title);
            $slug = $baseSlug;
            $counter = 1;
            
            // Unique slug kontrolü
            while (DB::table('activities')->where('slug', $slug)->where('id', '!=', $activity->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            DB::table('activities')->where('id', $activity->id)->update(['slug' => $slug]);
        }
        
        // Slug için unique index ekle (try-catch ile güvenli)
        try {
            Schema::table('activities', function (Blueprint $table) {
                $table->unique('slug');
            });
        } catch (\Exception $e) {
            // Index zaten varsa devam et
        }
        
        // Slug'ı nullable'dan çıkar (artık zorunlu)
        Schema::table('activities', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
