@extends('admin.base')

@section('title')
Yeni Maç Ekle
@endsection

@section('page-title')
Yeni Maç Ekle
@endsection

@section('content')
<div class="games-page">
    <h1 class="title">Yeni Maç Ekle</h1>
    
    <form action="{{ route('admin.games.store') }}" method="POST" class="form-container">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="home_team" class="form-label">Ev Sahibi Takım *</label>
                <input type="text" id="home_team" name="home_team" class="form-input" value="{{ old('home_team') }}" required>
                @error('home_team')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="away_team" class="form-label">Deplasman Takımı *</label>
                <input type="text" id="away_team" name="away_team" class="form-input" value="{{ old('away_team') }}" required>
                @error('away_team')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="match_date" class="form-label">Maç Tarihi *</label>
                <input type="date" id="match_date" name="match_date" class="form-input" value="{{ old('match_date') }}" required>
                @error('match_date')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="match_time" class="form-label">Maç Saati</label>
                <input type="time" id="match_time" name="match_time" class="form-input" value="{{ old('match_time') }}">
                @error('match_time')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="home_score" class="form-label">Ev Sahibi Skor</label>
                <input type="number" id="home_score" name="home_score" class="form-input" value="{{ old('home_score') }}" min="0">
                @error('home_score')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="away_score" class="form-label">Deplasman Skor</label>
                <input type="number" id="away_score" name="away_score" class="form-input" value="{{ old('away_score') }}" min="0">
                @error('away_score')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="status" class="form-label">Durum *</label>
            <select id="status" name="status" class="form-select" required>
                <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>Yakında</option>
                <option value="live" {{ old('status') === 'live' ? 'selected' : '' }}>Canlı</option>
                <option value="finished" {{ old('status') === 'finished' ? 'selected' : '' }}>Bitti</option>
            </select>
            @error('status')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">İptal</a>
            <button type="submit" class="btn-primary">Kaydet</button>
        </div>
    </form>
</div>
@endsection
