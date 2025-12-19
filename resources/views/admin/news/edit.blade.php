@extends('admin.base')

@section('title')
Haber Düzenle
@endsection

@section('page-title')
Haber Düzenle
@endsection

@section('content')
<div class="news-page">
    <h1 class="title">Haber Düzenle</h1>
    
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title" class="form-label">Başlık *</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $news->title) }}" required>
            @error('title')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="content" class="form-label">İçerik *</label>
            <!-- Quill Editor Container -->
            <div id="content-editor" style="min-height: 300px;"></div>
            <!-- Gizli textarea - Form submit için (required attribute kaldırıldı, JavaScript ile kontrol ediliyor) -->
            <textarea id="content" name="content" class="form-textarea" style="display: none;">{{ old('content', $news->content) }}</textarea>
            @error('content')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="author_id" class="form-label">Yazar *</label>
                <select id="author_id" name="author_id" class="form-select" required>
                    <option value="">Yazar Seçin</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id', $news->author_id) == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="category_id" class="form-label">Kategori *</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Kategori Seçin</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="image" class="form-label">Görsel</label>
            @if($news->image)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="preview-image">
                    <p class="image-info">Mevcut görsel</p>
                </div>
            @endif
            <input type="file" id="image" name="image" class="form-input" accept="image/*">
            @error('image')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.news.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Güncelle</button>
        </div>
    </form>
</div>
@endsection
