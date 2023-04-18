<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function socials(): hasOne
    {
        return $this->hasOne(Social::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Returns entity which is default one, otherwise the first one if there are no default
     */
    public function defaultPhoto(): HasOne
    {
        $photoQ = $this->hasOne(Photo::class)
            ->orderBy('is_default', 'desc')
            ->orderBy('id', 'asc');

        return $photoQ;
    }

    public function map(): HasOne
    {
        return $this->hasOne(Map::class);
    }
}
