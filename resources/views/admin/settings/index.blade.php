@extends('admin.base')

@section('title')
Ayarlar
@endsection

@section('page-title')
Ayarlar
@endsection

@section('content')
<div class="settings-page">
    <div class="settings-container">
        <!-- Profil Ayarları -->
        <div class="settings-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-user"></i>
                    Profil Ayarları
                </h2>
                <p class="section-description">Kişisel bilgilerinizi güncelleyin</p>
            </div>
            
            <div class="settings-card">
                <form action="{{ route('admin.settings.update-profile') }}" method="POST" class="settings-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Ad Soyad</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input @error('name') is-invalid @enderror" 
                               value="{{ old('name', $user->name) }}" 
                               required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">E-posta</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-input @error('email') is-invalid @enderror" 
                               value="{{ old('email', $user->email) }}" 
                               required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Rol</label>
                        <div class="form-info">
                            <span class="badge badge-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                {{ $user->role === 'admin' ? 'Admin' : 'Kullanıcı' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            <span>Değişiklikleri Kaydet</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Şifre Değiştirme -->
        <div class="settings-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-lock"></i>
                    Şifre Değiştir
                </h2>
                <p class="section-description">Hesap güvenliğiniz için düzenli olarak şifrenizi değiştirin</p>
            </div>
            
            <div class="settings-card">
                <form action="{{ route('admin.settings.update-password') }}" method="POST" class="settings-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password" class="form-label">Mevcut Şifre</label>
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               class="form-input @error('current_password') is-invalid @enderror" 
                               required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Yeni Şifre</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input @error('password') is-invalid @enderror" 
                               required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-key"></i>
                            <span>Şifreyi Değiştir</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Sistem Bilgileri -->
        <div class="settings-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Sistem Bilgileri
                </h2>
                <p class="section-description">Sistem ve uygulama hakkında bilgiler</p>
            </div>
            
            <div class="settings-card">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Laravel Versiyonu</span>
                        <span class="info-value">{{ app()->version() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">PHP Versiyonu</span>
                        <span class="info-value">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Sunucu Zamanı</span>
                        <span class="info-value">{{ now()->format('d.m.Y H:i:s') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Zaman Dilimi</span>
                        <span class="info-value">{{ config('app.timezone', 'UTC') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        setTimeout(function() {
            alert('{{ session('success') }}');
        }, 100);
    </script>
@endif
@endsection
