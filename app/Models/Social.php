<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    use HasFactory;

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public $timestamps = false;

    protected $fillable = [
        'facebook',
        'instagram',
        'twitter',
        'line',
        'tiktok',
        'youtube'
    ];
}
