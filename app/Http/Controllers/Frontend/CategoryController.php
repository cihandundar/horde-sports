<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Kategoriye göre haberleri göster
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $news = News::where('category_id', $category->id)
            ->with(['author', 'category'])
            ->latest()
            ->paginate(12);
        
        return view('front.pages.category', compact('category', 'news'));
    }
}
