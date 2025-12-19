<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Haber listesi
     */
    public function index()
    {
        $news = News::with(['author', 'category'])->latest()->paginate(10);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

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

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber başarıyla eklendi.');
    }

    /**
     * Haber düzenleme formu
     */
    public function edit(News $news)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'authors', 'categories'));
    }

    /**
     * Haber güncelle
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

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

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber başarıyla güncellendi.');
    }

    /**
     * Haber sil
     */
    public function destroy(News $news)
    {
        // Görseli sil
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Haber başarıyla silindi.');
    }
}
