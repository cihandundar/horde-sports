<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'home_team',
        'away_team',
        'match_date',
        'match_time',
        'home_score',
        'away_score',
        'status',
    ];

    /**
     * Tarih formatı
     */
    protected $casts = [
        'match_date' => 'date',
    ];

    /**
     * Status enum değerleri
     */
    const STATUS_UPCOMING = 'upcoming';
    const STATUS_LIVE = 'live';
    const STATUS_FINISHED = 'finished';

    /**
     * Maç durumuna göre skor gösterimi
     */
    public function getHomeScoreDisplayAttribute(): string
    {
        return $this->status === self::STATUS_FINISHED ? (string) $this->home_score : '-';
    }

    /**
     * Maç durumuna göre skor gösterimi
     */
    public function getAwayScoreDisplayAttribute(): string
    {
        return $this->status === self::STATUS_FINISHED ? (string) $this->away_score : '-';
    }
}
