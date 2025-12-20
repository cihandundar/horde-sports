@extends('admin.base')

@section('title')
Maçlar
@endsection

@section('page-title')
Maçlar
@endsection

@section('content')
<div class="games-page">
    <div class="page-header">
        <h1 class="title">Maçlar</h1>
        <a href="{{ route('admin.games.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            <span>Yeni Maç Ekle</span>
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Ev Sahibi Takım</th>
                    <th>Deplasman Takımı</th>
                    <th>Tarih</th>
                    <th>Saat</th>
                    <th>Skor</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($games as $game)
                <tr>
                    <td>{{ $game->home_team }}</td>
                    <td>{{ $game->away_team }}</td>
                    <td>{{ $game->match_date->format('d.m.Y') }}</td>
                    <td>{{ $game->match_time ? \Carbon\Carbon::parse($game->match_time)->format('H:i') : '-' }}</td>
                    <td>
                        @if(in_array($game->status, ['live', 'finished']) && ($game->home_score !== null || $game->away_score !== null))
                            {{ $game->home_score ?? '-' }} - {{ $game->away_score ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($game->status === 'finished')
                            <span class="status-badge status-finished">Bitti</span>
                        @elseif($game->status === 'live')
                            <span class="status-badge status-live">Canlı</span>
                        @else
                            <span class="status-badge status-upcoming">Yakında</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.games.edit', $game) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Bu maçı silmek istediğinize emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">Henüz maç eklenmemiş.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $games->links() }}
        </div>
    </div>
</div>
@endsection
