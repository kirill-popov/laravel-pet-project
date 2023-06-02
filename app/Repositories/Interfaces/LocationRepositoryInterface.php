<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\Shop;
use Illuminate\Support\Collection;

interface LocationRepositoryInterface
{
    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function updateLocation(array $data, Location $location): Location;
    public function destroyLocation(Location $location): Location;
    public function refreshLocation(Location $location): Location;
    public function associateWithShop(Shop $shop, Location $location): Location;
}
