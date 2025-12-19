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
                <h3 class="stat-value">0</h3>
                <p class="stat-label">Toplam Kullanıcı</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">0</h3>
                <p class="stat-label">Toplam Maç</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">0</h3>
                <p class="stat-label">Toplam Haber</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">0</h3>
                <p class="stat-label">Toplam Görüntülenme</p>
            </div>
        </div>
    </div>
    
    <div class="dashboard-sections">
        <div class="dashboard-section">
            <h2 class="section-title">Son Aktiviteler</h2>
            <div class="activity-list">
                <p class="empty-state">Henüz aktivite bulunmamaktadır.</p>
            </div>
        </div>
        
        <div class="dashboard-section">
            <h2 class="section-title">Hızlı İşlemler</h2>
            <div class="quick-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-plus"></i>
                    <span>Yeni Maç Ekle</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-plus"></i>
                    <span>Yeni Haber Ekle</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-user-plus"></i>
                    <span>Yeni Kullanıcı Ekle</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
