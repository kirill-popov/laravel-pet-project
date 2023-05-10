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
        return Location::create($data);
    }

    public function viewLocation(Location $location): Location
    {
        return $location;
    }

    public function updateLocation(array $data, Location $location): Location
    {
        $location_fillable = $location->getFillable();

        foreach ($location_fillable as $key) {
            if (isset($data[$key])) {
                $location->$key = $data[$key];
            }
        }
        $location->save();

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
}
