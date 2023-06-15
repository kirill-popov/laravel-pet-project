<?php

namespace App\Repositories;

use App\Models\Map;
use App\Models\Shop;
use App\Repositories\Interfaces\MapRepositoryInterface;

class MapRepository implements MapRepositoryInterface
{
    public function create(array $data): Map
    {
        $data['default_location_id'] = $data['location_id'];
        unset($data['location_id']);

        return Map::create($data);
    }

    public function associateWithShop(Map $map, Shop $shop): Map
    {
        $map->shop()->associate($shop);
        $map->save();

        return $map;
    }

    public function update(Map $map, array $data): Map
    {
        $map->update($data);

        return $map;
    }

    public function delete(Map $map): Map
    {
        $map->delete();

        return $map;
    }
}
