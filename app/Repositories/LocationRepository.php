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
        // return Location::where('shop_id', '=', $shop_id)->orderBy('name')->paginate();
        return $shop->locations;
    }

    public function storeLocation(array $data): Location
    {
        return $loc = Location::create($data);
    }

    public function viewLocation(Location $location): Location
    {
        // return Location::find($id);
        return $location;
    }

    public function updateLocation(array $data, int $id): Location
    {

    }

    public function destroyLocation(Location $location): Location
    {
        $location->delete();
        return $location;
    }
}
