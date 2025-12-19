<header class="header">
    <div class="header-container">
        <div class="header-logo">
            <a href="{{ url('/') }}" class="logo-link">
                <img src="{{ asset('front/assets/images/logo.png') }}" alt="Horde Sports Logo" class="logo-image">
            </a>
        </div>
        <nav class="header-nav">
            <ul class="header-menu">
                @php
                    $categories = \App\Models\Category::all();
                @endphp
                @foreach($categories as $category)
                <li class="menu-item">
                    <a href="{{ route('category.show', $category->slug) }}" class="menu-link">{{ $category->name }}</a>
                </li>
                @endforeach
                <li class="menu-item">
                    <a href="{{ route('authors.index') }}" class="menu-link">Yazarlar</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('blog.index') }}" class="menu-link">Blog</a>
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
            <!-- Arama Bölümü -->
            <div class="header-search">
                <button class="search-toggle" type="button" aria-label="Ara">
                    <i class="fas fa-search"></i>
                </button>
                <div class="search-overlay">
                    <div class="search-panel">
                        <div class="search-container">
                            <form class="search-form" action="#" method="GET">
                                <div class="search-input-wrapper">
                                    <input type="text" class="search-input" placeholder="Ara..." name="q" autocomplete="off" reqired>
                                    <button type="submit" class="search-submit-btn" aria-label="Ara">
                                        <i class="fas fa-search search-icon"></i>
                                    </button>
                                </div>
                                <button type="button" class="search-close" aria-label="Kapat">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

