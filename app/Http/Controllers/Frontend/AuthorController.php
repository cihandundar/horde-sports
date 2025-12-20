<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Yazarlar listesi
     */
    public function index()
    {
        $authors = Author::latest()->paginate(12);
        return view('front.pages.authors', compact('authors'));
    }

    /**
     * Yazar detay sayfası - Slug ile yazar göster
     */
    public function show($slug)
    {
        // Slug ile yazarı bul, haberleriyle birlikte
        $author = Author::where('slug', $slug)
            ->firstOrFail();
        
        // Yazarın haberleri - Sadece onaylanmış haberler
        $news = $author->news()
            ->where('is_approved', true)
            ->with(['category'])
            ->latest()
            ->paginate(12);
        
        return view('front.pages.author-detail', compact('author', 'news'));
    }
}
