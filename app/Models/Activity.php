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
        'description',
        'image',
        'order',
        'activityable_id',
        'activityable_type',
    ];

    /**
     * Polymorphic ilişki - Hem Author hem Category'ye bağlanabilir
     */
    public function activityable(): MorphTo
    {
        return $this->morphTo();
    }
}
