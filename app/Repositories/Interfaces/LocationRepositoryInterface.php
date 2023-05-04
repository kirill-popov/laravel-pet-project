<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\Shop;
use Illuminate\Support\Collection;

interface LocationRepositoryInterface
{
    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function viewLocation(Location $location): Location;
    public function updateLocation(array $data, int $id): Location;
    public function destroyLocation(Location $location);
}
