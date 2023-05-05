<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Shop;
use App\Models\Social;
use Illuminate\Support\Collection;

interface ShopServiceInterface
{
    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function viewLocation(Location $location): Location;
    public function updateLocation(array $data, int $id): Location;
    public function destroyLocation(Location $location);

    public function storeSocialsToLocation(array $data, Location $location): Social;
    public function updateSocials(array $data, Location $location): Collection;

    public function storePhotosToLocation(array $data, Location $location): Collection;
}
