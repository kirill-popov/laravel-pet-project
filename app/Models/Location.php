<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    // public function socials(): HasMany
    // {
    //     return $this->hasMany(Social::class);
    // }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
