<header class="header">
    <div class="header-container">
        <div class="header-logo">
            <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('front/assets/images/logo.png') }}" alt="Horde Sports Logo" class="logo-image">
            </a>
        </div>
        <nav class="header-nav">
            <ul class="header-menu">
                <li class="menu-item">
                    <a href="#" class="menu-link">Futbol</a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">Basketbol</a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">Voleybol</a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">Yazarlar</a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">Blog</a>
                </li>
            </ul>
            <div class="mobile-menu-auth">
                <a href="{{ route('login') }}" class="mobile-auth-link">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Giriş Yap</span>
                </a>
                <a href="{{ route('register') }}" class="mobile-auth-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Kayıt Ol</span>
                </a>
            </div>
        </nav>
        <div class="header-right">
            <div class="header-user-dropdown desktop-only">
                <button class="user-dropdown-toggle" type="button" aria-label="Kullanıcı menüsü">
                    <i class="fas fa-user"></i>
                </button>
                <div class="user-dropdown-menu">
                    <a href="{{ route('login') }}" class="dropdown-item">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Giriş Yap</span>
                    </a>
                    <a href="{{ route('register') }}" class="dropdown-item">
                        <i class="fas fa-user-plus"></i>
                        <span>Kayıt Ol</span>
                    </a>
                </div>
            </div>
            <button class="mobile-menu-toggle" type="button" aria-label="Menü">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

