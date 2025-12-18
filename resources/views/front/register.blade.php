@extends('front.base')

@section('title')
    Kayıt Ol
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="title">Kayıt Ol</h1>
            <p class="auth-subtitle">Yeni hesap oluşturarak başlayın</p>

            <form class="auth-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i>
                        Ad Soyad
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input" 
                        placeholder="Adınız ve soyadınız"
                        value="{{ old('name') }}"
                        required 
                        autofocus
                    >
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        E-posta Adresi
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="ornek@email.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Şifre
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="En az 8 karakter"
                        required
                    >
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock"></i>
                        Şifre Tekrar
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input" 
                        placeholder="Şifrenizi tekrar girin"
                        required
                    >
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" class="checkbox-input" required>
                        <span class="checkbox-text">Kullanım şartlarını ve gizlilik politikasını kabul ediyorum</span>
                    </label>
                </div>

                <button type="submit" class="auth-button">
                    <i class="fas fa-user-plus"></i>
                    Kayıt Ol
                </button>
            </form>

            <div class="auth-divider">
                <span>veya</span>
            </div>

            <div class="auth-footer">
                <p class="auth-footer-text">Zaten hesabınız var mı?</p>
                <a href="{{ route('login') }}" class="auth-link">Giriş Yap</a>
            </div>
        </div>
    </div>
</div>
@endsection

