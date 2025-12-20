@extends('front.base')

@section('title')
Yazarlar - Horde Sports
@endsection

@section('description')
Horde Sports'un deneyimli yazarlarını keşfedin ve en iyi spor analizleri ve haberleri okuyun.
@endsection

@section('keywords')
yazarlar, spor yazarları, spor analizleri, Horde Sports yazarları
@endsection

@section('content')
<div class="authors-page">
    @include('front.partials.breadcrumb')
    <h1 class="title">Yazarlar</h1>
    
    <div class="authors-grid">
        @forelse($authors as $author)
        <div class="author-card">
            @if($author->slug)
                <a href="{{ route('author.show', $author->slug) }}" class="author-card-link">
            @endif
            @if($author->photo)
                <div class="author-photo-wrapper">
                    <img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}" class="author-photo">
                </div>
            @else
                <div class="author-photo-placeholder">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <div class="author-info">
                <div class="author-name">{{ $author->name }}</div>
                @if($author->bio)
                    <p class="author-bio">{{ Str::limit(strip_tags($author->bio), 100) }}</p>
                @endif
            </div>
            @if($author->slug)
                </a>
            @endif
        </div>
        @empty
        <div class="empty-state">
            <p>Henüz yazar bulunmamaktadır.</p>
        </div>
        @endforelse
    </div>
    
    <div class="pagination-wrapper">
        {{ $authors->links() }}
    </div>
</div>
@endsection
