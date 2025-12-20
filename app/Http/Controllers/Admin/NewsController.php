<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Haber listesi
     * Admin ise tüm haberleri, kullanıcı ise sadece kendi haberlerini göster
     */
    public function index()
    {
        $query = News::with(['author', 'category', 'user']);
        
        // Kullanıcı ise sadece kendi haberlerini göster
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }
        
        $news = $query->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Yeni haber ekleme formu
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.news.create', compact('authors', 'categories'));
    }

    /**
     * Yeni haber kaydet
     */
    public function store(StoreNewsRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Görsel yükleme
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Slug oluştur - başlıktan otomatik slug oluştur
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        
        // Aynı slug varsa sonuna sayı ekle (unique olması için)
        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['slug'] = $slug;

        // Kullanıcı bilgilerini ekle
        $validated['user_id'] = Auth::id();
        
        // Admin ise otomatik onayla, kullanıcı ise onay beklesin
        $validated['is_approved'] = Auth::user()->isAdmin();

        News::create($validated);

        // Mesajı kullanıcı rolüne göre ayarla
        $message = Auth::user()->isAdmin() 
            ? 'Haber başarıyla eklendi.' 
            : 'Haber başarıyla eklendi. Admin onayından sonra yayınlanacaktır.';

        return redirect()->route('admin.news.index')
            ->with('success', $message);
    }

    /**
     * Haber düzenleme formu
     * Kullanıcılar sadece kendi haberlerini düzenleyebilir
     */
    public function edit(News $news)
    {
        // Kullanıcı ise sadece kendi haberlerini düzenleyebilir
        if (!Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Bu haberi düzenleme yetkiniz yok.');
        }

        $authors = Author::all();
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'authors', 'categories'));
    }

    /**
     * Haber güncelle
     * Kullanıcılar sadece kendi haberlerini güncelleyebilir
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        // Kullanıcı ise sadece kendi haberlerini güncelleyebilir
        if (!Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Bu haberi güncelleme yetkiniz yok.');
        }

        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();
        
        // Kullanıcı güncelleme yapıyorsa onay durumunu sıfırla (tekrar onay beklesin)
        if (!Auth::user()->isAdmin() && $news->is_approved) {
            $validated['is_approved'] = false;
        }

        // Yeni görsel yüklendiyse eski görseli sil
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Başlık değiştiyse slug'ı güncelle
        if ($request->title !== $news->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Aynı slug varsa sonuna sayı ekle (mevcut haber hariç)
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $validated['slug'] = $slug;
        }

        $news->update($validated);

        // Mesajı kullanıcı rolüne göre ayarla
        $message = Auth::user()->isAdmin() 
            ? 'Haber başarıyla güncellendi.' 
            : 'Haber başarıyla güncellendi. Admin onayından sonra yayınlanacaktır.';

        return redirect()->route('admin.news.index')
            ->with('success', $message);
    }

    /**
     * Haber sil
     */
    public function destroy(News $news)
    {
        // Kullanıcı ise sadece kendi haberlerini silebilir
        if (!Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Bu haberi silme yetkiniz yok.');
        }

        // Görseli sil
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber başarıyla silindi.');
    }

    /**
     * Haberi onayla (Sadece admin)
     */
    public function approve(News $news)
    {
        // Sadece admin onaylayabilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $news->update(['is_approved' => true]);

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber başarıyla onaylandı.');
    }

    /**
     * Haberi reddet (Sadece admin)
     */
    public function reject(News $news)
    {
        // Sadece admin reddedebilir
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('admin.news.index')
                ->with('error', 'Bu işlem için yetkiniz yok.');
        }

        $news->update(['is_approved' => false]);

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber reddedildi.');
    }
}
