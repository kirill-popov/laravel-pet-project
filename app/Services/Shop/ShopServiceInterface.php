<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface ShopServiceInterface
{
    public function setShopsOrder(string $order_by, string $order): ShopRepository;
    public function allShops(): Collection;
    public function allShopsPaginated(): Paginator;
    public function getShop(Shop $shop): Shop;
    public function findShopByName(string $name): Collection;
    public function findShopByNamePaginate(string $name): Paginator;
    public function createShop(array $data): Shop;

    public function getShopLocations(Shop $shop): Collection;
    public function storeLocation(array $data): Location;
    public function viewLocation(Location $location): Location;
    public function updateLocation(array $data, Location $location): Location;
    public function destroyLocation(Location $location);
}
