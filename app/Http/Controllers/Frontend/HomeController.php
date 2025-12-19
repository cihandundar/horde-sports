<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Ana sayfa
     */
    public function index()
    {
        // Son maçlar (en fazla 10 adet)
        $games = Game::orderBy('match_date', 'desc')
            ->orderBy('match_time', 'desc')
            ->limit(10)
            ->get();

        // Son haberler (en fazla 6 adet - blog section için)
        $news = News::with(['author', 'category'])
            ->latest()
            ->limit(6)
            ->get();

        return view('front.pages.home', compact('games', 'news'));
    }
}
