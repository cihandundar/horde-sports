<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Etkinlik detay sayfası - Slug ile etkinlik göster
     */
    public function show($slug)
    {
        // Slug ile etkinliği bul, activityable ilişkisiyle birlikte
        $activity = Activity::where('slug', $slug)
            ->with('activityable')
            ->firstOrFail();
        
        return view('front.pages.activity-detail', compact('activity'));
    }
}
