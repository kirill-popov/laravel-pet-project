<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;
use Illuminate\Support\Collection;

interface TilesRepositoryInterface
{
    public function getTiles(Shop $shop): Collection;
}
