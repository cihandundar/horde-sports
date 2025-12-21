@extends('admin.base')

@section('title')
Yazar Düzenle
@endsection

@section('page-title')
Yazar Düzenle
@endsection

@section('content')
<div class="authors-page">
    <div class="page-header-with-action">
        <h1 class="title">Yazar Düzenle</h1>
        <a href="{{ route('author.show', $author->slug) }}" target="_blank" class="btn-view-frontend">
            <i class="fas fa-external-link-alt"></i>
            <span>Ön Tarafta Görüntüle</span>
        </a>
    </div>
    
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
            <div id="bio-editor"></div>
            <!-- Gizli textarea - Form submit için -->
            <textarea id="bio" name="bio" class="form-textarea hidden">{{ old('bio', $author->bio) }}</textarea>
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

    <!-- Etkinlik Yönetimi Bölümü -->
    <div class="activities-management-section">
        <div class="activities-management-header">
            <h2 class="activities-management-title">Etkinlikler</h2>
            <a href="{{ route('admin.activities.create', ['activityable_type' => 'App\Models\Author', 'activityable_id' => $author->id]) }}" class="btn-primary btn-primary-with-icon">
                <i class="fas fa-plus"></i>
                <span>Yeni Etkinlik Ekle</span>
            </a>
        </div>

        @if($activities->count() > 0)
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Sıra</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id="author-activities-tbody" class="draggable-tbody" data-update-order-url="{{ route('admin.activities.update-order') }}" data-csrf-token="{{ csrf_token() }}">
                    @foreach($activities as $activity)
                    <tr class="draggable-row" data-id="{{ $activity->id }}" draggable="true">
                        <td class="drag-handle">
                            <i class="fas fa-grip-vertical"></i>
                        </td>
                        <td>
                            @if($activity->images && count($activity->images) > 0)
                                <img src="{{ asset('storage/' . $activity->images[0]) }}" alt="{{ $activity->title }}" class="activity-thumb">
                                @if(count($activity->images) > 1)
                                    <div class="activity-thumb-badge">
                                        <i class="fas fa-images"></i>
                                        <span>{{ count($activity->images) }}</span>
                                    </div>
                                @endif
                            @else
                                <div class="activity-thumb-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $activity->title }}</td>
                        <td>{{ Str::limit(strip_tags($activity->description ?? 'Açıklama yok'), 50) }}</td>
                        <td>{{ $activity->order }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.activities.edit', $activity) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="activities-empty-state">
            <p>Bu yazara ait henüz etkinlik bulunmamaktadır.</p>
            <a href="{{ route('admin.activities.create', ['activityable_type' => 'App\Models\Author', 'activityable_id' => $author->id]) }}" class="btn-primary btn-primary-with-icon">
                <i class="fas fa-plus"></i>
                <span>İlk Etkinliği Ekle</span>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
