<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Etkinlik listesi - Order'a göre sıralı
     */
    public function index()
    {
        $activities = Activity::with('activityable')->orderBy('order')->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Yeni etkinlik ekleme formu
     */
    public function create(Request $request)
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        
        // Query parametrelerinden gelen değerler (yazar/kategori edit sayfasından)
        $preselectedType = $request->get('activityable_type');
        $preselectedId = $request->get('activityable_id');
        
        return view('admin.activities.create', compact('authors', 'categories', 'preselectedType', 'preselectedId'));
    }

    /**
     * Yeni etkinlik kaydet
     */
    public function store(Request $request)
    {
        // Validasyon
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'activityable_type' => 'required|in:App\Models\Author,App\Models\Category',
            'activityable_id' => 'required|integer',
        ]);

        // Resim yükleme
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('activities', 'public');
        }

        // Order varsayılan değeri
        if (!isset($validated['order'])) {
            $validated['order'] = 0;
        }

        // Polymorphic ilişki için activityable_type ve activityable_id ayarla
        $activityableType = $validated['activityable_type'];
        $activityableId = $validated['activityable_id'];

        // Seçilen model'in varlığını kontrol et
        $activityable = $activityableType::findOrFail($activityableId);

        // Activity oluştur
        Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'order' => $validated['order'],
            'activityable_type' => $activityableType,
            'activityable_id' => $activityableId,
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Etkinlik başarıyla eklendi.');
    }

    /**
     * Etkinlik düzenleme formu
     */
    public function edit(Activity $activity)
    {
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.activities.edit', compact('activity', 'authors', 'categories'));
    }

    /**
     * Etkinlik güncelle
     */
    public function update(Request $request, Activity $activity)
    {
        // Validasyon
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'activityable_type' => 'required|in:App\Models\Author,App\Models\Category',
            'activityable_id' => 'required|integer',
        ]);

        // Yeni resim yüklendiyse eski resmi sil
        if ($request->hasFile('image')) {
            if ($activity->image) {
                Storage::disk('public')->delete($activity->image);
            }
            $validated['image'] = $request->file('image')->store('activities', 'public');
        }

        // Order varsayılan değeri
        if (!isset($validated['order'])) {
            $validated['order'] = 0;
        }

        // Polymorphic ilişki için activityable_type ve activityable_id ayarla
        $activityableType = $validated['activityable_type'];
        $activityableId = $validated['activityable_id'];

        // Seçilen model'in varlığını kontrol et
        $activityable = $activityableType::findOrFail($activityableId);

        // Activity güncelle
        $activity->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? $activity->image,
            'order' => $validated['order'],
            'activityable_type' => $activityableType,
            'activityable_id' => $activityableId,
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Etkinlik başarıyla güncellendi.');
    }

    /**
     * Etkinlik sil
     */
    public function destroy(Activity $activity)
    {
        // Resmi sil
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Etkinlik başarıyla silindi.');
    }

    /**
     * Etkinlik sıralamasını güncelle (Drag and Drop için)
     */
    public function updateOrder(Request $request)
    {
        // Validasyon - activity_ids array olmalı
        $validated = $request->validate([
            'activity_ids' => 'required|array',
            'activity_ids.*' => 'required|integer|exists:activities,id',
        ]);

        // Her activity için order değerini güncelle
        foreach ($validated['activity_ids'] as $index => $activityId) {
            Activity::where('id', $activityId)->update(['order' => $index + 1]);
        }

        // Başarılı yanıt döndür
        return response()->json([
            'success' => true,
            'message' => 'Etkinlik sıralaması başarıyla güncellendi.'
        ]);
    }
}
