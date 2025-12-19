@extends('front.base')

@section('title')
Blog - Horde Sports
@endsection

@section('content')
<div class="blog-page">
    @include('front.partials.breadcrumb')
    <h1 class="title">Blog</h1>
    
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
                <h2 class="news-title">
                    @if($item->slug)
                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                    @else
                        {{ $item->title }}
                    @endif
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
            <p>Henüz haber bulunmamaktadır.</p>
        </div>
        @endforelse
    </div>
    
    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
</div>
@endsection
