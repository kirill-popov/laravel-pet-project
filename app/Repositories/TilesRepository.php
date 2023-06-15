<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\TilesRepositoryInterface;
use Illuminate\Support\Collection;

class TileRepository implements TilesRepositoryInterface
{
    public function getTiles(Shop $shop): Collection
    {
        return $shop->tiles();
    }
}
