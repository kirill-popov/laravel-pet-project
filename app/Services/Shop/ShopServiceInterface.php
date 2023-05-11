<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Shop;
use Illuminate\Support\Collection;

interface ShopServiceInterface
{
    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function viewLocation(Location $location): Location;
    public function updateLocation(array $data, Location $location): Location;
    public function destroyLocation(Location $location);
}
