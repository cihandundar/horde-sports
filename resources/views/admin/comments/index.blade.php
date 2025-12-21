@extends('admin.base')

@section('title')
Yorumlar
@endsection

@section('content')
<div class="page-header">
    <h1 class="title">Yorumlar</h1>
    
    <!-- Filtreleme -->
    <div class="comments-page-header">
        <a href="{{ route('admin.comments.index') }}" class="btn-secondary {{ request('status') == null ? 'active' : '' }}">
            Tümü
        </a>
        <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="btn-secondary {{ request('status') == 'pending' ? 'active' : '' }}">
            Onay Bekleyenler
        </a>
        <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="btn-secondary {{ request('status') == 'approved' ? 'active' : '' }}">
            Onaylananlar
        </a>
    </div>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Yorum</th>
                <th>Yazar</th>
                <th>Haber</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr>
                <td>
                    <div class="comment-content-wrapper">
                        {{ Str::limit($comment->content, 100) }}
                    </div>
                </td>
                <td>
                    {{ $comment->author_name }}
                    @if($comment->user)
                        <div class="comment-content-text">
                            <i class="fas fa-user-check"></i> Üye
                        </div>
                    @else
                        <div class="comment-content-text">
                            <i class="fas fa-user-times"></i> Misafir
                        </div>
                    @endif
                </td>
                <td>
                    <a href="{{ route('news.show', $comment->news->slug) }}" target="_blank" class="comment-news-link">
                        {{ Str::limit($comment->news->title, 40) }}
                        <i class="fas fa-external-link-alt comment-news-link-icon"></i>
                    </a>
                </td>
                <td>
                    {{ $comment->created_at->format('d.m.Y H:i') }}
                </td>
                <td>
                    @if($comment->is_approved)
                        <span class="badge badge-primary">Onaylandı</span>
                    @else
                        <span class="badge badge-secondary">Onay Bekliyor</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons">
                        @if(!$comment->is_approved)
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="inline-form">
                            @csrf
                            <button type="submit" class="btn-edit" title="Onayla">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.comments.reject', $comment) }}" method="POST" class="inline-form">
                            @csrf
                            <button type="submit" class="btn-edit btn-approve-remove" title="Onayı Kaldır">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                        
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="delete-form inline-form comment-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Sil">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="table-empty-center">
                    Henüz yorum bulunmamaktadır.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrapper">
    {{ $comments->links() }}
</div>
@endsection
