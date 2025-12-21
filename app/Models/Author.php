<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Author extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'photo',
    ];

    /**
     * Yazarın haberleri
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * Yazarın etkinlikleri (polymorphic ilişki)
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'activityable')->orderBy('order');
    }
}
