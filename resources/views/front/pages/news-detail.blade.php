@extends('front.base')

@section('title')
{{ $news->title }} - Horde Sports
@endsection

@section('description')
{{ Str::limit(strip_tags($news->content), 160) }}
@endsection

@section('keywords')
{{ $news->category->name }}, {{ $news->author->name }}, spor, haber, {{ $news->title }}
@endsection

@section('og-image')
@if($news->image)
{{ asset('storage/' . $news->image) }}
@else
{{ asset('front/assets/images/og-image.jpg') }}
@endif
@endsection

@section('og-type')
article
@endsection

@section('content')
<div class="news-detail-page">
    <!-- Breadcrumb Navigasyon - Otomatik oluşturulur -->
    @include('front.partials.breadcrumb')

    <!-- Haber Detay İçeriği -->
    <article class="news-detail">
        <!-- Haber Başlığı -->
        <h1 class="title">{{ $news->title }}</h1>
        
        <!-- Haber Meta Bilgileri -->
        <div class="news-detail-meta">
            <span class="meta-item">
                <i class="fas fa-user"></i>
                <a href="{{ route('authors.index') }}">{{ $news->author->name }}</a>
            </span>
            <span class="meta-item">
                <i class="fas fa-tag"></i>
                <a href="{{ route('category.show', $news->category->slug) }}">{{ $news->category->name }}</a>
            </span>
            <span class="meta-item">
                <i class="fas fa-calendar"></i>
                {{ $news->created_at->format('d.m.Y H:i') }}
            </span>
        </div>

        <!-- Haber Görseli -->
        @if($news->image)
        <div class="news-detail-image">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="detail-image">
        </div>
        @endif

        <!-- Haber İçeriği -->
        <div class="news-detail-content">
            {!! $news->content !!}
        </div>
        
        <!-- Sosyal Medya Paylaşım Butonları -->
        @include('front.partials.social-share', ['news' => $news])
    </article>

    <!-- Yorumlar Bölümü -->
    @include('front.partials.comments-section', ['news' => $news, 'comments' => $comments ?? collect()])

    <!-- İlgili Haberler -->
    @if($relatedNews->count() > 0)
    <section class="related-news-section">
        <div class="section-title">İlgili Haberler</div>
        <div class="related-news-grid">
            @foreach($relatedNews as $item)
            <article class="related-news-card">
                @if($item->image)
                <div class="related-news-image-wrapper">
                    @if($item->slug)
                        <a href="{{ route('news.show', $item->slug) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="related-news-image">
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="related-news-image">
                    @endif
                </div>
                @endif
                <div class="related-news-content">
                    <div class="related-news-category">
                        <i class="fas fa-tag"></i>
                        {{ $item->category->name }}
                    </div>
                    <div class="related-news-title">
                        @if($item->slug)
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        @else
                            {{ $item->title }}
                        @endif
                    </div>
                    <p class="related-news-excerpt">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                    <div class="related-news-meta">
                        <span class="related-news-author">
                            <i class="fas fa-user"></i>
                            {{ $item->author->name }}
                        </span>
                        <span class="related-news-date">
                            <i class="fas fa-calendar"></i>
                            {{ $item->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
