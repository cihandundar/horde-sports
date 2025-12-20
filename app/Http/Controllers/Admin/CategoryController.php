<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Kategori listesi
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Yeni kategori ekleme formu
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Yeni kategori kaydet
     */
    public function store(StoreCategoryRequest $request)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Slug oluştur
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla eklendi.');
    }

    /**
     * Kategori düzenleme formu
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Kategori güncelle
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Form validasyonu Form Request tarafından yapılıyor
        $validated = $request->validated();

        // Slug oluştur
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla güncellendi.');
    }

    /**
     * Kategori sil
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla silindi.');
    }
}
