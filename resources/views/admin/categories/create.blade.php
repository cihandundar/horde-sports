@extends('admin.base')

@section('title')
Yeni Kategori Ekle
@endsection

@section('page-title')
Yeni Kategori Ekle
@endsection

@section('content')
<div class="categories-page">
    <h1 class="title">Yeni Kategori Ekle</h1>
    
    <form action="{{ route('admin.categories.store') }}" method="POST" class="form-container">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Kategori Adı *</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            <p class="form-hint">Slug otomatik olarak oluşturulacaktır.</p>
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Kaydet</button>
        </div>
    </form>
</div>
@endsection
