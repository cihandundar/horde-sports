<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Author;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin dashboard sayfasını göster
     */
    public function index()
    {
        // İstatistikler
        $totalUsers = User::count();
        $totalNews = News::count();
        $totalAuthors = Author::count();
        $totalMatches = 0; // Maç sistemi henüz yok
        
        // Son haberler
        $recentNews = News::with(['author', 'category'])
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalNews',
            'totalAuthors',
            'totalMatches',
            'recentNews'
        ));
    }
}
