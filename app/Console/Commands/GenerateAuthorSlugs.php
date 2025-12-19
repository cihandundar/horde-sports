<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Author;
use Illuminate\Support\Str;

class GenerateAuthorSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'authors:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Slug\'ı olmayan tüm yazarlar için otomatik slug oluşturur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Slug oluşturma işlemi başlatılıyor...');
        
        // Slug'ı olmayan veya boş olan tüm yazarları bul
        $authorsWithoutSlugs = Author::whereNull('slug')
            ->orWhere('slug', '')
            ->get();
        
        if ($authorsWithoutSlugs->isEmpty()) {
            $this->info('Slug\'ı olmayan yazar bulunamadı. Tüm yazarların slug\'ı mevcut.');
            return Command::SUCCESS;
        }
        
        $this->info($authorsWithoutSlugs->count() . ' adet yazar için slug oluşturulacak...');
        
        $bar = $this->output->createProgressBar($authorsWithoutSlugs->count());
        $bar->start();
        
        $updated = 0;
        $skipped = 0;
        
        foreach ($authorsWithoutSlugs as $author) {
            // İsim yoksa atla
            if (empty($author->name)) {
                $skipped++;
                $bar->advance();
                continue;
            }
            
            // İsimden slug oluştur
            $baseSlug = Str::slug($author->name);
            
            // Eğer isim slug'a çevrilemezse (boş string olursa) atla
            if (empty($baseSlug)) {
                $skipped++;
                $bar->advance();
                continue;
            }
            
            $slug = $baseSlug;
            $counter = 1;
            
            // Aynı slug varsa sonuna sayı ekle (unique olması için)
            while (Author::where('slug', $slug)->where('id', '!=', $author->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            // Slug'ı güncelle
            $author->slug = $slug;
            $author->save();
            
            $updated++;
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        $this->info("İşlem tamamlandı!");
        $this->info("✓ {$updated} adet yazar için slug oluşturuldu.");
        
        if ($skipped > 0) {
            $this->warn("⚠ {$skipped} adet yazar atlandı (isim yok veya slug oluşturulamadı).");
        }
        
        return Command::SUCCESS;
    }
}
