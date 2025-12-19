<header class="admin-header">
    <div class="header-right">
        <div class="user-menu">
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">{{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}</span>
            </div>
            <div class="user-actions">
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Çıkış</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
