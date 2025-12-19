<aside class="admin-sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-logo">Horde Sports</h1>
        <p class="sidebar-subtitle">Admin Panel</p>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Kullanıcılar</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-futbol"></i>
                    <span>Maçlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Haberler</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Ayarlar</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i>
            <span>Siteye Git</span>
        </a>
    </div>
</aside>
