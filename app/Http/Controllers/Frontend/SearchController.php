<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Arama sonuçları
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query || trim($query) === '') {
            return redirect()->route('home');
        }
        
        $news = News::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->with(['author', 'category'])
            ->latest()
            ->paginate(12);
        
        return view('front.pages.search', compact('news', 'query'));
    }
}
