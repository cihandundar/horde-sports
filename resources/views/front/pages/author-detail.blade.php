@extends('front.base')

@section('title')
{{ $author->name }} - Horde Sports
@endsection

@section('description')
@if($author->bio)
{{ Str::limit(strip_tags($author->bio), 160) }}
@else
{{ $author->name }}'in Horde Sports'taki tüm yazılarını ve analizlerini keşfedin.
@endif
@endsection

@section('keywords')
{{ $author->name }}, yazar, spor yazarı, {{ $author->name }} yazıları, Horde Sports
@endsection

@section('og-image')
@if($author->photo)
{{ asset('storage/' . $author->photo) }}
@else
{{ asset('front/assets/images/og-image.jpg') }}
@endif
@endsection

@section('content')
<div class="author-detail-page">
    <!-- Breadcrumb Navigasyon - Otomatik oluşturulur -->
    @include('front.partials.breadcrumb')

    <!-- Yazar Detay İçeriği -->
    <article class="author-detail">
        <div class="author-detail-header">
            <!-- Yazar Fotoğrafı -->
            <div class="author-detail-photo">
                @if($author->photo)
                    <img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}" class="author-detail-image">
                @else
                    <div class="author-detail-photo-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>

            <!-- Yazar Bilgileri -->
            <div class="author-detail-info">
                <h1 class="title">{{ $author->name }}</h1>
                
                @if($author->bio)
                <div class="author-detail-bio">
                    {!! $author->bio !!}
                </div>
                @endif
            </div>
        </div>
    </article>

    <!-- Yazarın Haberleri -->
    <section class="author-news-section">
        <div class="section-title">{{ $author->name }}'in Haberleri</div>
        
        @if($news->count() > 0)
        <div class="news-grid">
            @foreach($news as $item)
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
                        <span class="news-date">
                            <i class="fas fa-calendar"></i>
                            {{ $item->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="pagination-wrapper">
            {{ $news->links() }}
        </div>
        @else
        <div class="empty-state">
            <p>Bu yazara ait henüz haber bulunmamaktadır.</p>
        </div>
        @endif
    </section>
</div>
@endsection
