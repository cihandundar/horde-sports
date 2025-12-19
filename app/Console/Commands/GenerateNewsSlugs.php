<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Str;

class GenerateNewsSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Slug\'ı olmayan tüm haberler için otomatik slug oluşturur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Slug oluşturma işlemi başlatılıyor...');
        
        // Slug'ı olmayan veya boş olan tüm haberleri bul
        $newsWithoutSlugs = News::whereNull('slug')
            ->orWhere('slug', '')
            ->get();
        
        if ($newsWithoutSlugs->isEmpty()) {
            $this->info('Slug\'ı olmayan haber bulunamadı. Tüm haberlerin slug\'ı mevcut.');
            return Command::SUCCESS;
        }
        
        $this->info($newsWithoutSlugs->count() . ' adet haber için slug oluşturulacak...');
        
        $bar = $this->output->createProgressBar($newsWithoutSlugs->count());
        $bar->start();
        
        $updated = 0;
        $skipped = 0;
        
        foreach ($newsWithoutSlugs as $news) {
            // Başlık yoksa atla
            if (empty($news->title)) {
                $skipped++;
                $bar->advance();
                continue;
            }
            
            // Başlıktan slug oluştur
            $baseSlug = Str::slug($news->title);
            
            // Eğer başlık slug'a çevrilemezse (boş string olursa) atla
            if (empty($baseSlug)) {
                $skipped++;
                $bar->advance();
                continue;
            }
            
            $slug = $baseSlug;
            $counter = 1;
            
            // Aynı slug varsa sonuna sayı ekle (unique olması için)
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            // Slug'ı güncelle
            $news->slug = $slug;
            $news->save();
            
            $updated++;
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        $this->info("İşlem tamamlandı!");
        $this->info("✓ {$updated} adet haber için slug oluşturuldu.");
        
        if ($skipped > 0) {
            $this->warn("⚠ {$skipped} adet haber atlandı (başlık yok veya slug oluşturulamadı).");
        }
        
        return Command::SUCCESS;
    }
}
