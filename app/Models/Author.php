<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
