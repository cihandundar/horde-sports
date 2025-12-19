<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Fotoğraf yükleme
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
        }

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Yazar başarıyla eklendi.');
    }

    /**
     * Yazar düzenleme formu
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Yazar güncelle
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Yeni fotoğraf yüklendiyse eski fotoğrafı sil
        if ($request->hasFile('photo')) {
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
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
