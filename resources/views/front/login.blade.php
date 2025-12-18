@extends('front.base')

@section('title')
    Giriş Yap
@endsection


@section('content')
<div class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="title">Giriş Yap</h1>
            <p class="auth-subtitle">Hesabınıza giriş yaparak devam edin</p>

            <form class="auth-form" method="POST" action="{{ route('login') }}">
                @csrf

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
                        autofocus
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
                        placeholder="Şifrenizi girin"
                        required
                    >
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" class="checkbox-input">
                        <span class="checkbox-text">Beni hatırla</span>
                    </label>
                    <a href="#" class="forgot-link">Şifremi unuttum</a>
                </div>

                <button type="submit" class="auth-button">
                    <i class="fas fa-sign-in-alt"></i>
                    Giriş Yap
                </button>
            </form>

            <div class="auth-divider">
                <span>veya</span>
            </div>

            <div class="auth-footer">
                <p class="auth-footer-text">Hesabınız yok mu?</p>
                <a href="{{ route('register') }}" class="auth-link">Kayıt Ol</a>
            </div>
        </div>
    </div>
</div>
@endsection

