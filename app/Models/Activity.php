<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    /**
     * Doldurulabilir alanlar
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'images',
        'order',
        'activityable_id',
        'activityable_type',
    ];

    /**
     * Cast edilecek alanlar
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Polymorphic ilişki - Hem Author hem Category'ye bağlanabilir
     */
    public function activityable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * İlk resmi döndürür (geriye dönük uyumluluk için)
     */
    public function getFirstImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return null;
    }
}
