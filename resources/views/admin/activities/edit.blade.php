@extends('admin.base')

@section('title')
Etkinlik Düzenle
@endsection

@section('page-title')
Etkinlik Düzenle
@endsection

@section('content')
<div class="activities-page">
    <h1 class="title">Etkinlik Düzenle</h1>
    
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title" class="form-label">Başlık *</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $activity->title) }}" required>
            @error('title')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description" class="form-label">Açıklama</label>
            <textarea id="description" name="description" class="form-textarea" rows="4">{{ old('description', $activity->description) }}</textarea>
            @error('description')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="images" class="form-label">Resimler (Maksimum 5 adet)</label>
            
            <!-- Mevcut resimler -->
            @if($activity->images && count($activity->images) > 0)
            <div class="existing-images-container">
                <p class="form-hint">Mevcut resimler (sil için X butonuna tıklayın):</p>
                <div class="existing-images-grid">
                    @foreach($activity->images as $index => $image)
                    <div class="existing-image-item" data-image-path="{{ $image }}">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $activity->title }} - Resim {{ $index + 1 }}" class="existing-image-preview">
                        <button type="button" class="remove-image-btn" data-image-path="{{ $image }}">
                            <i class="fas fa-times"></i>
                        </button>
                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Yeni resim yükleme -->
            <input type="file" id="images" name="images[]" class="form-input" accept="image/*" multiple>
            <p class="form-hint">Yeni resimler ekleyebilirsiniz. Toplam maksimum 5 resim olabilir.</p>
            @error('images')
                <span class="form-error">{{ $message }}</span>
            @enderror
            @error('images.*')
                <span class="form-error">{{ $message }}</span>
            @enderror
            
            <!-- Yeni resim önizleme alanı -->
            <div id="images-preview" class="images-preview-container"></div>
            
            <!-- Silinecek resimler için hidden input -->
            <div id="deleted-images-container"></div>
        </div>
        
        <div class="form-group">
            <label for="activityable_type" class="form-label">Bağlı Olduğu Tip *</label>
            <select id="activityable_type" 
                    name="activityable_type" 
                    class="form-input" 
                    required
                    data-authors="{{ json_encode($authors) }}"
                    data-categories="{{ json_encode($categories) }}"
                    data-current-id="{{ old('activityable_id', $activity->activityable_id) }}">
                <option value="">Seçiniz...</option>
                <option value="App\Models\Author" {{ old('activityable_type', $activity->activityable_type) === 'App\Models\Author' ? 'selected' : '' }}>Yazar</option>
                <option value="App\Models\Category" {{ old('activityable_type', $activity->activityable_type) === 'App\Models\Category' ? 'selected' : '' }}>Kategori</option>
            </select>
            @error('activityable_type')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="activityable_id" class="form-label">Bağlı Olduğu *</label>
            <select id="activityable_id" name="activityable_id" class="form-input" required>
                <option value="">Seçiniz...</option>
            </select>
            @error('activityable_id')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="order" class="form-label">Sıra (0 = en üstte)</label>
            <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $activity->order) }}" min="0">
            @error('order')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.activities.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Güncelle</button>
        </div>
    </form>
</div>
@endsection
