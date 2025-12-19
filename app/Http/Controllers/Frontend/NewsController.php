<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Haber detay sayfası - Slug ile haber göster
     */
    public function show($slug)
    {
        // Slug ile haberi bul, yazar ve kategori bilgileriyle birlikte
        $news = News::where('slug', $slug)
            ->with(['author', 'category'])
            ->firstOrFail();
        
        // İlgili haberler - Aynı kategorideki diğer haberler
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->with(['author', 'category'])
            ->latest()
            ->limit(4)
            ->get();
        
        return view('front.pages.news-detail', compact('news', 'relatedNews'));
    }
}
