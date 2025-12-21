@extends('front.base')

@section('title')
{{ $activity->title }} - Horde Sports
@endsection

@section('description')
@if($activity->description)
{{ Str::limit(strip_tags($activity->description), 160) }}
@else
{{ $activity->title }} etkinlik detayları ve galerisi.
@endif
@endsection

@section('keywords')
{{ $activity->title }}, etkinlik, {{ $activity->activityable->name }}, Horde Sports
@endsection

@section('og-image')
@if($activity->main_image)
{{ asset('storage/' . $activity->main_image) }}
@elseif($activity->images && count($activity->images) > 0)
{{ asset('storage/' . $activity->images[0]) }}
@else
{{ asset('front/assets/images/og-image.jpg') }}
@endif
@endsection

@section('content')
<div class="activity-detail-page">
    <!-- Breadcrumb Navigasyon - Otomatik oluşturulur -->
    @include('front.partials.breadcrumb')

    <!-- Etkinlik Detay İçeriği -->
    <article class="activity-detail">
        <!-- Etkinlik Başlığı -->
        <h1 class="title">{{ $activity->title }}</h1>
        
        <!-- Etkinlik Meta Bilgileri -->
        <div class="activity-detail-meta">
            <span class="meta-item">
                <i class="fas fa-tag"></i>
                @if($activity->activityable_type === 'App\Models\Author')
                    <a href="{{ route('author.show', $activity->activityable->slug) }}">{{ $activity->activityable->name }}</a>
                @elseif($activity->activityable_type === 'App\Models\Category')
                    <a href="{{ route('category.show', $activity->activityable->slug) }}">{{ $activity->activityable->name }}</a>
                @endif
            </span>
            <span class="meta-item">
                <i class="fas fa-calendar"></i>
                {{ $activity->created_at->format('d.m.Y H:i') }}
            </span>
        </div>

        <!-- Ana Görsel -->
        @if($activity->main_image)
        <div class="activity-main-image">
            <img src="{{ asset('storage/' . $activity->main_image) }}" alt="{{ $activity->title }}" class="detail-image">
        </div>
        @endif

        <!-- Etkinlik İçeriği -->
        @if($activity->description)
        <div class="activity-detail-content">
            {!! $activity->description !!}
        </div>
        @endif
        
        <!-- Galeri Bölümü - En Alt -->
        @if($activity->images && count($activity->images) > 0)
        <section class="activity-gallery-section">
            <div class="section-title">Galeri</div>
            <div class="activity-gallery-grid">
                @foreach($activity->images as $image)
                <div class="activity-gallery-item">
                    <a href="{{ asset('storage/' . $image) }}" data-fancybox="activity-gallery" data-caption="{{ $activity->title }}">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $activity->title }}" class="activity-gallery-image">
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </article>
</div>
@endsection
