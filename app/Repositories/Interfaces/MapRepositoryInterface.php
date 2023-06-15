<?php

namespace App\Repositories\Interfaces;

use App\Models\Map;
use App\Models\Shop;

interface MapRepositoryInterface
{
    public function create(array $data): Map;
    public function associateWithShop(Map $map, Shop $shop): Map;
    public function update(Map $map, array $data): Map;
    public function delete(Map $map): Map;
}
