<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'news_id',
        'user_id',
        'name',
        'email',
        'content',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * Yorumun ait olduğu haber
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Yorumu yapan kullanıcı (eğer giriş yapmışsa)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Yorum yapan kişinin adını döndür
     */
    public function getAuthorNameAttribute(): string
    {
        return $this->user ? $this->user->name : ($this->name ?? 'Anonim');
    }
}
