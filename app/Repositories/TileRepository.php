<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Models\Tile;
use App\Repositories\Interfaces\TileRepositoryInterface;

class TileRepository implements TileRepositoryInterface
{
    public function createTile(array $data): Tile
    {
        return Tile::create($data);
    }

    public function associateWithShop(Tile $tile, Shop $shop): Tile
    {
        $tile->shop()->associate($shop);
        $tile->save();

        return $tile;
    }

    public function updateTile(Tile $tile, array $data): Tile
    {
        $tile->update($data);

        return $tile;
    }
}
