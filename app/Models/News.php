<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'category_id',
        'user_id',
        'is_approved',
    ];

    /**
     * Haberi ekleyen kullanıcı
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Haberin yazarı
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Haberin kategorisi
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Haberin yorumları
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Onaylanmış yorumlar
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    /**
     * Haberin onaylanıp onaylanmadığını kontrol et
     */
    public function isApproved(): bool
    {
        return $this->is_approved === true;
    }
}
