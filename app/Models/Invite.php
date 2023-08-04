<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invite extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'shop_id',
        'role_id'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeAdmins(Builder $query)
    {
        $query->whereHas('role', function (Builder $query) {
            $query->admin();
        });
    }

    public function scopeShopInvites(Builder $query, Shop $shop)
    {
        $query->where('shop_id', $shop->id);
    }
}
