<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAuthorRequest;
use App\Http\Requests\Admin\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Yazar listesi
     */
    public function index()
    {
        $authors = Author::latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Yeni yazar ekleme formu
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Yeni yazar kaydet
     */
    public function store(StoreAuthorRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Fotoğraf yükleme
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
        }

        // Slug oluştur - isimden otomatik slug oluştur
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        
        // Aynı slug varsa sonuna sayı ekle (unique olması için)
        while (Author::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['slug'] = $slug;

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Yazar başarıyla eklendi.');
    }

    /**
     * Yazar düzenleme formu
     */
    public function edit(Author $author)
    {
        // Yazarın etkinliklerini order'a göre sıralı yükle
        $activities = $author->activities()->orderBy('order')->get();
        return view('admin.authors.edit', compact('author', 'activities'));
    }

    /**
     * Yazar güncelle
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Yeni fotoğraf yüklendiyse eski fotoğrafı sil
        if ($request->hasFile('photo')) {
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
        }

        // İsim değiştiyse slug'ı güncelle
        if ($request->name !== $author->name) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Aynı slug varsa sonuna sayı ekle (mevcut yazar hariç)
            while (Author::where('slug', $slug)->where('id', '!=', $author->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $validated['slug'] = $slug;
        }

        $author->update($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Yazar başarıyla güncellendi.');
    }

    /**
     * Yazar sil
     */
    public function destroy(Author $author)
    {
        // Fotoğrafı sil
        if ($author->photo) {
            Storage::disk('public')->delete($author->photo);
        }

        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Yazar başarıyla silindi.');
    }
}
