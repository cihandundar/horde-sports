<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Tüm haberler (Blog) - Sadece onaylanmış haberler
     */
    public function index()
    {
        $news = News::with(['author', 'category'])
            ->where('is_approved', true)
            ->latest()
            ->paginate(12);
        return view('front.pages.blog', compact('news'));
    }
}
