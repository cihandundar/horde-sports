@extends('admin.base')

@section('title')
Yeni Yazar Ekle
@endsection

@section('page-title')
Yeni Yazar Ekle
@endsection

@section('content')
<div class="authors-page">
    <h1 class="title">Yeni Yazar Ekle</h1>
    
    <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Ad Soyad *</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="bio" class="form-label">Biyografi</label>
            <textarea id="bio" name="bio" class="form-textarea" rows="5">{{ old('bio') }}</textarea>
            @error('bio')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="photo" class="form-label">Fotoğraf</label>
            <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
            @error('photo')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.authors.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Kaydet</button>
        </div>
    </form>
</div>
@endsection
