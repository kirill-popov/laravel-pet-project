<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\Shop;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use Illuminate\Support\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    public function getShopLocations(Shop $shop): Collection
    {
        return $shop->locations;
    }

    public function getLocationById(int $id): Location|null
    {
        return Location::find($id);
    }

    public function storeLocation(array $data): Location
    {
        return Location::create($data);
    }

    public function updateLocation(array $data, Location $location): Location
    {
        $location->update($data);

        return $location;
    }

    public function destroyLocation(Location $location): Location
    {
        $location->delete();

        return $location;
    }

    public function refreshLocation(Location $location): Location
    {
        return $location->refresh();
    }

    public function associateWithShop(Shop $shop, Location $location): Location
    {
        $location->shop()->associate($shop);
        $location->save();

        return $location;
    }
}
