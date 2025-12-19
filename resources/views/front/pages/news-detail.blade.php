@extends('front.base')

@section('title')
{{ $news->title }} - Horde Sports
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
    </article>

    <!-- İlgili Haberler -->
    @if($relatedNews->count() > 0)
    <section class="related-news-section">
        <h2 class="section-title">İlgili Haberler</h2>
        <div class="related-news-grid">
            @foreach($relatedNews as $item)
            <article class="related-news-card">
                @if($item->image)
                <div class="related-news-image-wrapper">
                    <a href="{{ route('news.show', $item->slug) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="related-news-image">
                    </a>
                </div>
                @endif
                <div class="related-news-content">
                    <div class="related-news-category">
                        <i class="fas fa-tag"></i>
                        {{ $item->category->name }}
                    </div>
                    <h3 class="related-news-title">
                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                    </h3>
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
