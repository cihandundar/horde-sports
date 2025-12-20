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
                @auth
                    {{-- Giriş yapmış kullanıcı için mobil menü --}}
                    <div class="mobile-user-info">
                        <div class="mobile-user-initials">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                        <div class="mobile-user-details">
                            <div class="mobile-user-name">{{ auth()->user()->name }}</div>
                            <div class="mobile-user-role">{{ auth()->user()->role === 'admin' ? 'Admin' : 'Kullanıcı' }}</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="mobile-auth-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Panele Git</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mobile-logout-form">
                        @csrf
                        <button type="submit" class="mobile-auth-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Çıkış Yap</span>
                        </button>
                    </form>
                @else
                    {{-- Giriş yapmamış kullanıcı için mobil menü --}}
                    <a href="{{ route('login') }}" class="mobile-auth-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Giriş Yap</span>
                    </a>
                    <a href="{{ route('register') }}" class="mobile-auth-link">
                        <i class="fas fa-user-plus"></i>
                        <span>Kayıt Ol</span>
                    </a>
                @endauth
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
                            <form class="search-form" action="{{ route('search') }}" method="GET">
                                <div class="search-input-wrapper">
                                    <input type="text" class="search-input" placeholder="Ara..." name="q" autocomplete="off" required>
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
                @auth
                    {{-- Giriş yapmış kullanıcı için baş harfler ve menü --}}
                    <button class="user-dropdown-toggle" type="button" aria-label="Kullanıcı menüsü">
                        <span class="user-initials">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </button>
                    <div class="user-dropdown-menu">
                        <div class="dropdown-user-info">
                            <div class="dropdown-user-initials">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                            <div class="dropdown-user-details">
                                <span class="dropdown-user-name">{{ auth()->user()->name }}</span>
                                <span class="dropdown-user-role">{{ auth()->user()->role === 'admin' ? 'Admin' : 'Kullanıcı' }}</span>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Panele Git</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Çıkış Yap</span>
                            </button>
                        </form>
                    </div>
                @else
                    {{-- Giriş yapmamış kullanıcı için ikon ve menü --}}
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
                @endauth
            </div>
            <button class="mobile-menu-toggle" type="button" aria-label="Menü">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

