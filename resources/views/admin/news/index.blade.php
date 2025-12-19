@extends('admin.base')

@section('title')
Haberler
@endsection

@section('page-title')
Haberler
@endsection

@section('content')
<div class="news-page">
    <div class="page-header">
        <h1 class="title">Haberler</h1>
        <a href="{{ route('admin.news.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            <span>Yeni Haber Ekle</span>
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Görsel</th>
                    <th>Başlık</th>
                    <th>Yazar</th>
                    <th>Kategori</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                        @else
                            <div class="news-image-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ Str::limit($item->title, 50) }}</td>
                    <td>{{ $item->author->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Bu haberi silmek istediğinize emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">Henüz haber eklenmemiş.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
