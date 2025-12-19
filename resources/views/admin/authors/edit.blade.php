@extends('admin.base')

@section('title')
Yazar Düzenle
@endsection

@section('page-title')
Yazar Düzenle
@endsection

@section('content')
<div class="authors-page">
    <h1 class="title">Yazar Düzenle</h1>
    
    <form action="{{ route('admin.authors.update', $author) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Ad Soyad *</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $author->name) }}" required>
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="bio" class="form-label">Biyografi</label>
            <!-- Quill Editor Container -->
            <div id="bio-editor" style="min-height: 200px;"></div>
            <!-- Gizli textarea - Form submit için -->
            <textarea id="bio" name="bio" class="form-textarea" style="display: none;">{{ old('bio', $author->bio) }}</textarea>
            @error('bio')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="photo" class="form-label">Fotoğraf</label>
            @if($author->photo)
                <div class="current-photo">
                    <img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}" class="preview-photo">
                    <p class="photo-info">Mevcut fotoğraf</p>
                </div>
            @endif
            <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
            @error('photo')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.authors.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Güncelle</button>
        </div>
    </form>
</div>
@endsection
