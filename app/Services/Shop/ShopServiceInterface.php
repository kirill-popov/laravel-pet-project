<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Map;
use App\Models\Shop;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface ShopServiceInterface
{
    public function getAllShops(): Collection;
    public function getPaginatedShops(): Paginator;
    public function getShop(Shop $shop): Shop;
    public function searchShopsByName(string $string): Collection;
    public function searchShopsByNamePaginated(string $string): Paginator;
    public function createShop(array $data): Shop;

    public function getCurrentUserShopLocations(): Collection;
    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function updateLocation(array $data, Location $location): Location;
    public function destroyLocation(Location $location);

    public function getCurrentUserShopMap(): Map;
    public function createCurrentUserShopMap(array $data): Map;
    public function updateCurrentUserShopMap(Map $map, array $data): Map;
    public function deleteCurrentUserShopMap(Map $map): Map;
}
