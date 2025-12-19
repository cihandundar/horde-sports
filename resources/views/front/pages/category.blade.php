@extends('front.base')

@section('title')
{{ $category->name }} - Horde Sports
@endsection

@section('content')
<div class="category-page">
    @include('front.partials.breadcrumb')
    <h1 class="title">{{ $category->name }}</h1>
    
    <div class="news-grid">
        @forelse($news as $item)
        <article class="news-card">
            @if($item->image)
                <div class="news-image-wrapper">
                    <a href="{{ route('news.show', $item->slug) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                    </a>
                </div>
            @endif
            <div class="news-content">
                <h2 class="news-title">
                    <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                </h2>
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
            <p>Bu kategoride henüz haber bulunmamaktadır.</p>
        </div>
        @endforelse
    </div>
    
    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
</div>
@endsection
