<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

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
