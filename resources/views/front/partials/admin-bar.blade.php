@auth
<div class="admin-bar">
    <div class="admin-bar-container">
        <div class="admin-bar-content">
            @if(auth()->user()->isAdmin())
                {{-- Admin kullanıcılar için butonlar --}}
                @if(isset($news) && $news && !($news instanceof \Illuminate\Support\Collection) && method_exists($news, 'getKey'))
                    <a href="{{ route('admin.news.edit', $news) }}" class="admin-bar-btn admin-bar-btn-edit">
                        <i class="fas fa-edit"></i>
                        <span>İçeriği Düzenle</span>
                    </a>
                @endif
                <a href="{{ route('admin.dashboard') }}" class="admin-bar-btn admin-bar-btn-dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Admin Paneli</span>
                </a>
            @else
                {{-- Normal kullanıcılar için butonlar --}}
                <a href="{{ route('admin.dashboard') }}" class="admin-bar-btn admin-bar-btn-dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Panele Git</span>
                </a>
            @endif
        </div>
    </div>
</div>
@endauth
