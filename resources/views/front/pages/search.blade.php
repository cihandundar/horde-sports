@extends('front.base')

@section('title')
Arama Sonuçları - Horde Sports
@endsection

@section('content')
<div class="blog-page">
    @include('front.partials.breadcrumb')
    <h1 class="title">Arama Sonuçları</h1>
    
    @if($query)
        <p style="margin-bottom: 24px; color: #777777; font-size: 14px;">
            "<strong>{{ $query }}</strong>" için {{ $news->total() }} sonuç bulundu
        </p>
    @endif
    
    <div class="news-grid">
        @forelse($news as $item)
        <article class="news-card">
            @if($item->image)
                <div class="news-image-wrapper">
                    @if($item->slug)
                        <a href="{{ route('news.show', $item->slug) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="news-image">
                    @endif
                </div>
            @endif
            <div class="news-content">
                <div class="news-category">
                    <i class="fas fa-tag"></i>
                    @if($item->category && $item->category->slug)
                        <a href="{{ route('category.show', $item->category->slug) }}">{{ $item->category->name }}</a>
                    @else
                        {{ $item->category->name }}
                    @endif
                </div>
                <div class="news-title">
                    @if($item->slug)
                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                    @else
                        {{ $item->title }}
                    @endif
                </div>
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
            <p>"{{ $query }}" için sonuç bulunamadı.</p>
        </div>
        @endforelse
    </div>
    
    @if($news->hasPages())
    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
