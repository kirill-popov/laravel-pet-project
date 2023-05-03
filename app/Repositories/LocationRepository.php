<?php

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    public function shopLocations(int $shop_id)
    {
        return Location::where('shop_id', '=', $shop_id)->orderBy('name')->paginate();
    }

    public function storeLocation(array $data)
    {
        return Location::create($data);
    }

    public function viewLocation(int $id)
    {
        return Location::find($id);
    }

    public function updateLocation($data, $id)
    {

    }

    public function destroyLocation($id)
    {

    }
}
