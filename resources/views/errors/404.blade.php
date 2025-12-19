@extends('front.base')

@section('title')
404 - Sayfa Bulunamadı - Horde Sports
@endsection

@section('content')
<div class="error-page">
    <div class="error-container">
        <!-- 404 Sayı ve İkon -->
        <div class="error-code-wrapper">
            <div class="error-code">404</div>
            <div class="error-icon">
                <i class="fas fa-search"></i>
            </div>
        </div>

        <!-- Hata Başlığı -->
        <h1 class="title">Sayfa Bulunamadı</h1>

        <!-- Hata Açıklaması -->
        <div class="error-description">
            <p>Aradığınız sayfa mevcut değil veya taşınmış olabilir.</p>
            <p>Lütfen URL'yi kontrol edin veya ana sayfaya dönün.</p>
        </div>

        <!-- Ana Sayfaya Dön Butonu -->
        <div class="error-actions">
            <a href="{{ route('home') }}" class="error-btn error-btn-primary">
                <i class="fas fa-home"></i>
                <span>Ana Sayfaya Dön</span>
            </a>
            <a href="javascript:history.back()" class="error-btn error-btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Geri Git</span>
            </a>
        </div>

        <!-- Popüler Linkler -->
        <div class="error-links">
            <div class="error-links-title">Popüler Sayfalar</div>
            <div class="error-links-grid">
                <a href="{{ route('blog.index') }}" class="error-link-item">
                    <i class="fas fa-newspaper"></i>
                    <span>Blog</span>
                </a>
                <a href="{{ route('authors.index') }}" class="error-link-item">
                    <i class="fas fa-users"></i>
                    <span>Yazarlar</span>
                </a>
                <a href="{{ route('home') }}" class="error-link-item">
                    <i class="fas fa-home"></i>
                    <span>Ana Sayfa</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
