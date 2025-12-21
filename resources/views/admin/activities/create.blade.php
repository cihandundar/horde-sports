@extends('admin.base')

@section('title')
Yeni Etkinlik Ekle
@endsection

@section('page-title')
Yeni Etkinlik Ekle
@endsection

@section('content')
<div class="activities-page">
    <h1 class="title">Yeni Etkinlik Ekle</h1>
    
    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        
        <div class="form-group">
            <label for="title" class="form-label">Başlık *</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
            @error('title')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description" class="form-label">Açıklama</label>
            <textarea id="description" name="description" class="form-textarea" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="images" class="form-label">Resimler (Maksimum 5 adet)</label>
            <input type="file" id="images" name="images[]" class="form-input" accept="image/*" multiple>
            <p class="form-hint">Maksimum 5 resim seçebilirsiniz. Galeri görünümü için kullanılacaktır.</p>
            @error('images')
                <span class="form-error">{{ $message }}</span>
            @enderror
            @error('images.*')
                <span class="form-error">{{ $message }}</span>
            @enderror
            
            <!-- Resim önizleme alanı -->
            <div id="images-preview" class="images-preview-container"></div>
        </div>
        
        <div class="form-group">
            <label for="activityable_type" class="form-label">Bağlı Olduğu Tip *</label>
            <select id="activityable_type" 
                    name="activityable_type" 
                    class="form-input" 
                    required
                    data-authors="{{ json_encode($authors) }}"
                    data-categories="{{ json_encode($categories) }}"
                    data-preselected-id="{{ old('activityable_id', $preselectedId ?? null) }}">
                <option value="">Seçiniz...</option>
                <option value="App\Models\Author" {{ old('activityable_type', $preselectedType ?? '') === 'App\Models\Author' ? 'selected' : '' }}>Yazar</option>
                <option value="App\Models\Category" {{ old('activityable_type', $preselectedType ?? '') === 'App\Models\Category' ? 'selected' : '' }}>Kategori</option>
            </select>
            @error('activityable_type')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="activityable_id" class="form-label">Bağlı Olduğu *</label>
            <select id="activityable_id" name="activityable_id" class="form-input" required disabled>
                <option value="">Önce tip seçiniz...</option>
            </select>
            @error('activityable_id')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="order" class="form-label">Sıra (0 = en üstte)</label>
            <input type="number" id="order" name="order" class="form-input" value="{{ old('order', 0) }}" min="0">
            @error('order')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.activities.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Kaydet</button>
        </div>
    </form>
</div>
@endsection
