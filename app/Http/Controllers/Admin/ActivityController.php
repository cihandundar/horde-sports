<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        // Validasyon - maksimum 5 resim
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'activityable_type' => 'required|in:App\Models\Author,App\Models\Category',
            'activityable_id' => 'required|integer',
        ]);

        // Resim yükleme - birden fazla resim
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('activities', 'public');
            }
        }

        // Order varsayılan değeri
        if (!isset($validated['order'])) {
            $validated['order'] = 0;
        }

        // Slug oluştur - başlıktan otomatik slug oluştur
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        
        // Aynı slug varsa sonuna sayı ekle (unique olması için)
        while (Activity::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Polymorphic ilişki için activityable_type ve activityable_id ayarla
        $activityableType = $validated['activityable_type'];
        $activityableId = $validated['activityable_id'];

        // Seçilen model'in varlığını kontrol et
        $activityable = $activityableType::findOrFail($activityableId);

        // Activity oluştur
        Activity::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'images' => !empty($images) ? $images : null,
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
        // Validasyon - maksimum 5 resim
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'string',
            'order' => 'nullable|integer|min:0',
            'activityable_type' => 'required|in:App\Models\Author,App\Models\Category',
            'activityable_id' => 'required|integer',
        ]);

        // Mevcut resimleri al
        $currentImages = $activity->images ?? [];
        
        // Silinecek resimleri işle
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $deletedImage) {
                // Storage'dan sil
                Storage::disk('public')->delete($deletedImage);
                // Array'den kaldır
                $currentImages = array_filter($currentImages, function($img) use ($deletedImage) {
                    return $img !== $deletedImage;
                });
            }
            $currentImages = array_values($currentImages); // Index'leri düzenle
        }

        // Yeni resimleri yükle
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImages[] = $image->store('activities', 'public');
            }
        }

        // Mevcut ve yeni resimleri birleştir
        $allImages = array_merge($currentImages, $newImages);
        // Maksimum 5 resim kontrolü
        if (count($allImages) > 5) {
            $allImages = array_slice($allImages, 0, 5);
        }

        // Order varsayılan değeri
        if (!isset($validated['order'])) {
            $validated['order'] = 0;
        }

        // İsim değiştiyse slug'ı güncelle
        $slug = $activity->slug;
        if ($request->title !== $activity->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Aynı slug varsa sonuna sayı ekle (mevcut activity hariç)
            while (Activity::where('slug', $slug)->where('id', '!=', $activity->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
        }

        // Polymorphic ilişki için activityable_type ve activityable_id ayarla
        $activityableType = $validated['activityable_type'];
        $activityableId = $validated['activityable_id'];

        // Seçilen model'in varlığını kontrol et
        $activityable = $activityableType::findOrFail($activityableId);

        // Activity güncelle
        $activity->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'images' => !empty($allImages) ? $allImages : null,
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
        // Tüm resimleri sil
        if ($activity->images && is_array($activity->images)) {
            foreach ($activity->images as $image) {
                Storage::disk('public')->delete($image);
            }
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
