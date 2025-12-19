<section class="matches-slider-section">
    <div class="matches-slider-container">
        <div class="matches-slider-header">
            <p class="section-title">Maçlar ve Skorlar</p>
            <div class="slider-controls">
                <button class="slider-btn slider-prev" type="button" aria-label="Önceki">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn slider-next" type="button" aria-label="Sonraki">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="matches-slider-wrapper">
            <div class="swiper matches-swiper">
                <div class="swiper-wrapper">
                    @forelse($games ?? [] as $game)
                        <div class="swiper-slide">
                            <div class="match-card">
                                <div class="match-date">
                                    <i class="far fa-calendar"></i>
                                    <span>{{ $game->match_date->format('d F Y') }}</span>
                                </div>
                                <div class="match-teams">
                                    <div class="team">
                                        <i class="fas fa-futbol team-ball-logo"></i>
                                        <span class="team-name">{{ $game->home_team }}</span>
                                        <span class="team-score">
                                            {{ $game->status === 'finished' ? $game->home_score : '-' }}
                                        </span>
                                    </div>
                                    <div class="match-vs">VS</div>
                                    <div class="team">
                                        <i class="fas fa-futbol team-ball-logo"></i>
                                        <span class="team-name">{{ $game->away_team }}</span>
                                        <span class="team-score">
                                            {{ $game->status === 'finished' ? $game->away_score : '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="match-status">
                                    @if($game->status === 'finished')
                                        <span class="status-badge status-finished">Bitti</span>
                                    @elseif($game->status === 'live')
                                        <span class="status-badge status-live">Canlı</span>
                                    @else
                                        <span class="status-badge status-upcoming">Yakında</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="match-card">
                                <div class="match-date">
                                    <i class="far fa-calendar"></i>
                                    <span>Henüz maç bulunmamaktadır</span>
                                </div>
                                <div class="match-teams">
                                    <div class="team">
                                        <i class="fas fa-futbol team-ball-logo"></i>
                                        <span class="team-name">-</span>
                                        <span class="team-score">-</span>
                                    </div>
                                    <div class="match-vs">VS</div>
                                    <div class="team">
                                        <i class="fas fa-futbol team-ball-logo"></i>
                                        <span class="team-name">-</span>
                                        <span class="team-score">-</span>
                                    </div>
                                </div>
                                <div class="match-status">
                                    <span class="status-badge status-upcoming">Yakında</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
