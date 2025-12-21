@extends('front.base')

@section('title')
{{ $category->name }} - Horde Sports
@endsection

@section('description')
{{ $category->name }} kategorisindeki en güncel spor haberleri ve analizleri Horde Sports'ta okuyun.
@endsection

@section('keywords')
{{ $category->name }}, spor, haber, {{ $category->name }} haberleri, Horde Sports
@endsection

@section('content')
<div class="category-page">
    @include('front.partials.breadcrumb')
    <h1 class="title">{{ $category->name }}</h1>
    
    <!-- Visual Section - Manuel olarak activities verisi gönderilirse görünür -->
    @include('front.partials.visual-section', [
        'title' => isset($visualSectionTitle) ? $visualSectionTitle : 'Etkinlikler',
        'activities' => isset($activities) ? $activities : collect(),
        'emptyMessage' => isset($visualSectionEmptyMessage) ? $visualSectionEmptyMessage : null
    ])
    
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
            <p>Bu kategoride henüz haber bulunmamaktadır.</p>
        </div>
        @endforelse
    </div>
    
    <div class="pagination-wrapper">
        {{ $news->links() }}
    </div>
</div>
@endsection
