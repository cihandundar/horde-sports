@extends('admin.base')

@section('title')
Kategori Düzenle
@endsection

@section('page-title')
Kategori Düzenle
@endsection

@section('content')
<div class="categories-page">
    <h1 class="title">Kategori Düzenle</h1>
    
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Kategori Adı *</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $category->name) }}" required>
            <p class="form-hint">Slug otomatik olarak güncellenecektir.</p>
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Güncelle</button>
        </div>
    </form>
</div>
@endsection
