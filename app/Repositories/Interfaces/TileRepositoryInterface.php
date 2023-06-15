<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;
use App\Models\Tile;

interface TileRepositoryInterface
{
    public function createTile(array $data): Tile;
    public function associateWithShop(Tile $tile, Shop $shop): Tile;
    public function updateTile(Tile $tile, array $data): Tile;
    public function deleteTile(Tile $tile): Tile;
}
