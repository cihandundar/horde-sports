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
            <label for="image" class="form-label">Resim</label>
            @if($activity->image)
                <div class="current-photo">
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="preview-photo">
                    <p class="photo-info">Mevcut resim</p>
                </div>
            @endif
            <input type="file" id="image" name="image" class="form-input" accept="image/*">
            @error('image')
                <span class="form-error">{{ $message }}</span>
            @enderror
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
