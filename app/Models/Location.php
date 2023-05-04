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

    protected $fillable = [
        'shop_id',
        'name',
        'is_enabled',
        'latitude',
        'longitude',
        'zip',
        'prefecture_id',
        'address',
        'address2',
        'phone',
        'email',
        'business_hours_start',
        'business_hours_end',
        'workday_mon',
        'workday_tue',
        'workday_wed',
        'workday_thu',
        'workday_fri',
        'workday_sat',
        'workday_sun',
        'description',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'workday_mon' => 'boolean',
        'workday_tue' => 'boolean',
        'workday_wed' => 'boolean',
        'workday_thu' => 'boolean',
        'workday_fri' => 'boolean',
        'workday_sat' => 'boolean',
        'workday_sun' => 'boolean',
    ];

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

    public function map(): HasOne
    {
        return $this->hasOne(Map::class);
    }
}
