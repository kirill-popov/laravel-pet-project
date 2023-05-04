<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Shop;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use Illuminate\Support\Collection;

class ShopService implements ShopServiceInterface
{
    public function __construct(
        protected LocationRepositoryInterface $locationRepository,
    ) {
    }

    public function getShopLocations(Shop $shop): Collection
    {
        return $this->locationRepository->getShopLocations($shop);
    }

    public function storeLocation(array $data): Location
    {
        return $this->locationRepository->storeLocation($data);
    }

    public function viewLocation(Location $location): Location
    {
        return $this->locationRepository->viewLocation($location)->load([
            'prefecture',
            'photos',
            'socials'
        ]);
    }

    public function updateLocation(array $data, int $id): Location
    {
        return $this->locationRepository->updateLocation($data, $id);
    }

    public function destroyLocation(Location $location)
    {
        return $this->locationRepository->destroyLocation($location);
    }

}
