<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Map extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'default_location_id');
    }
}
