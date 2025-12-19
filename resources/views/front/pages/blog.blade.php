@extends('front.base')

@section('title')
Blog - Horde Sports
@endsection

@section('content')
<div class="blog-page">
    <h1 class="title">Blog</h1>
    
    <div class="news-grid">
        @forelse($news as $item)
        <article class="news-card">
            @if($item->image)
                <div class="news-image-wrapper">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                </div>
            @endif
            <div class="news-content">
                <div class="news-category">
                    <i class="fas fa-tag"></i>
                    {{ $item->category->name }}
                </div>
                <h2 class="news-title">{{ $item->title }}</h2>
                <p class="news-excerpt">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                <div class="news-meta">
                    <span class="news-author">
                        <i class="fas fa-user"></i>
                        {{ $item->author->name }}
                    </span>
                    <span class="news-date">
                        <i class="fas fa-calendar"></i>
                        {{ $item->created_at->format('d.m.Y') }}
                    </span>
                </div>
            </div>
        </article>
        @empty
        <div class="empty-state">
            <p>Henüz haber bulunmamaktadır.</p>
        </div>
        @endforelse
    </div>
    
    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
</div>
@endsection
