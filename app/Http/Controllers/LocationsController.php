<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Http\Requests\LocationUpdateFormRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\Shop\ShopService;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    protected $locationRepository;
    protected $socialsRepository;

    public function __construct(
        protected readonly ShopService $shopService,
    ) {
    }

    public function index(Request $request): LocationCollection
    {
        $shop = $request->user()->shop;

        return new LocationCollection(
            $this->shopService->getShopLocations($shop)
        );
    }

    public function store(LocationFormRequest $request): LocationResource
    {
        $data = $request->validated();

        $data['shop_id'] = $request->user()->shop->id;
        $location = $this->shopService->storeLocation($data);

        return new LocationResource($location);
    }

    public function show(Location $location): LocationResource
    {
        return new LocationResource($this->shopService->viewLocation($location));
    }

    public function update(LocationUpdateFormRequest $request, Location $location)
    {
        return new LocationResource($this->shopService->updateLocation($request->validated(), $location));
    }

    public function destroy(Location $location): LocationResource
    {
        return new LocationResource($this->shopService->destroyLocation($location));
    }
}
