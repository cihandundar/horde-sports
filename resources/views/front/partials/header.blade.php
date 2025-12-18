<header class="header">
    <div class="header-container">
        <div class="header-logo">
            <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('front/assets/images/logo.png') }}" alt="Horde Sports Logo" class="logo-image">
            </a>
        </div>
        <nav class="header-nav">
            <div class="header-auth-links">
                <a href="{{ route('login') }}" class="header-auth-link header-login-link">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Giriş Yap</span>
                </a>
                <a href="{{ route('register') }}" class="header-auth-link header-register-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Kayıt Ol</span>
                </a>
            </div>
        </nav>
    </div>
</header>

