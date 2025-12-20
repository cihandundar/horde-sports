<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Haber detay sayfası - Slug ile haber göster (Sadece onaylanmış haberler)
     */
    public function show($slug)
    {
        // Slug ile haberi bul, yazar ve kategori bilgileriyle birlikte - Sadece onaylanmış haberler
        $news = News::where('slug', $slug)
            ->where('is_approved', true)
            ->with(['author', 'category'])
            ->firstOrFail();
        
        // Onaylanmış yorumları getir (kullanıcı bilgileriyle birlikte)
        $comments = $news->approvedComments()
            ->with('user')
            ->latest()
            ->get();
        
        // İlgili haberler - Aynı kategorideki diğer onaylanmış haberler
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('is_approved', true)
            ->with(['author', 'category'])
            ->latest()
            ->limit(4)
            ->get();
        
        return view('front.pages.news-detail', compact('news', 'relatedNews', 'comments'));
    }
}
