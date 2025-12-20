@extends('admin.base')

@section('title')
Dashboard
@endsection

@section('page-title')
Dashboard
@endsection

@section('content')
<div class="dashboard-page">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalUsers }}</div>
                <p class="stat-label">Toplam Kullanıcı</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalMatches }}</div>
                <p class="stat-label">Toplam Maç</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalNews }}</div>
                <p class="stat-label">Toplam Haber</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $totalAuthors }}</h3>
                <p class="stat-label">Toplam Yazar</p>
            </div>
        </div>
    </div>
    
    <div class="dashboard-sections">
        <div class="dashboard-section">
            <div class="section-title">Son Haberler</div>
            <div class="activity-list">
                @forelse($recentNews as $item)
                <div class="activity-item">
                    <div class="activity-content">
                        <div class="activity-title">{{ $item->title }}</div>
                        <p class="activity-meta">
                            <span class="activity-category">{{ $item->category->name }}</span>
                            <span class="activity-author">{{ $item->author->name }}</span>
                            <span class="activity-date">{{ $item->created_at->format('d.m.Y H:i') }}</span>
                        </p>
                    </div>
                </div>
                @empty
                <p class="empty-state">Henüz haber bulunmamaktadır.</p>
                @endforelse
            </div>
        </div>
        
        <div class="dashboard-section">
            <div class="section-title">Hızlı İşlemler</div>
            <div class="quick-actions">
                <a href="{{ route('admin.games.create') }}" class="action-btn">
                    <i class="fas fa-plus"></i>
                    <span>Yeni Maç Ekle</span>
                </a>
                <a href="{{ route('admin.news.create') }}" class="action-btn">
                    <i class="fas fa-plus"></i>
                    <span>Yeni Haber Ekle</span>
                </a>
                <a href="{{ route('admin.authors.create') }}" class="action-btn">
                    <i class="fas fa-user-plus"></i>
                    <span>Yeni Yazar Ekle</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="action-btn">
                    <i class="fas fa-tag"></i>
                    <span>Yeni Kategori Ekle</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
