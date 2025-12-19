@extends('admin.base')

@section('title')
Yazarlar
@endsection

@section('page-title')
Yazarlar
@endsection

@section('content')
<div class="authors-page">
    <div class="page-header">
        <h1 class="title">Yazarlar</h1>
        <a href="{{ route('admin.authors.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            <span>Yeni Yazar Ekle</span>
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Fotoğraf</th>
                    <th>Ad</th>
                    <th>Biyografi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr>
                    <td>
                        @if($author->photo)
                            <img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}" class="author-photo">
                        @else
                            <div class="author-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $author->name }}</td>
                    <td>{{ Str::limit($author->bio ?? 'Biyografi yok', 50) }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.authors.edit', $author) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Bu yazarı silmek istediğinize emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">Henüz yazar eklenmemiş.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $authors->links() }}
        </div>
    </div>
</div>
@endsection
