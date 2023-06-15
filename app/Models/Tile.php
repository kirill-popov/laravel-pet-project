<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tile extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const SIZE_SM = 'sm';
    public const SIZE_MD = 'md';
    public const SIZE_LG = 'lg';
    public const SIZE_XL = 'xl';

    protected $casts = [
        'img_only' => 'boolean',
        'is_enabled' => 'boolean',
    ];

    protected $fillable = [
        'is_enabled',
        'type',
        'link_to',
        'title',
        'subtitle',
        'img_url',
        'img_only',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}
