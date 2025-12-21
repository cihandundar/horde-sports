@extends('admin.base')

@section('title')
Etkinlikler
@endsection

@section('page-title')
Etkinlikler
@endsection

@section('content')
<div class="activities-page">
    <div class="page-header">
        <h1 class="title">Etkinlikler</h1>
        <a href="{{ route('admin.activities.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            <span>Yeni Etkinlik Ekle</span>
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>Resim</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Bağlı Olduğu</th>
                    <th>Sıra</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody id="activities-tbody" class="draggable-tbody" data-update-order-url="{{ route('admin.activities.update-order') }}" data-csrf-token="{{ csrf_token() }}">
                @forelse($activities as $activity)
                <tr class="draggable-row" data-id="{{ $activity->id }}" draggable="true">
                    <td class="drag-handle">
                        <i class="fas fa-grip-vertical"></i>
                    </td>
                    <td>
                        @if($activity->image)
                            <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="activity-thumb">
                        @else
                            <div class="activity-thumb-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $activity->title }}</td>
                    <td>{{ Str::limit(strip_tags($activity->description ?? 'Açıklama yok'), 50) }}</td>
                    <td>
                        @if($activity->activityable_type === 'App\Models\Author')
                            <span class="badge badge-author">
                                <i class="fas fa-user-edit"></i>
                                {{ $activity->activityable->name }}
                            </span>
                        @elseif($activity->activityable_type === 'App\Models\Category')
                            <span class="badge badge-category">
                                <i class="fas fa-tag"></i>
                                {{ $activity->activityable->name }}
                            </span>
                        @endif
                    </td>
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
                @empty
                <tr>
                    <td colspan="7" class="empty-state">Henüz etkinlik eklenmemiş.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection
