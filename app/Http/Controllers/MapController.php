<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapCreateRequest;
use App\Http\Resources\MapResource;
use App\Models\Map;
use App\Services\Shop\ShopService;

class MapController extends Controller
{
    public function __construct(
        protected readonly ShopService $shopService
    ) {
    }

    public function index(): MapResource
    {
        return new MapResource(
            $this->shopService->getCurrentUserShopMap()
        );
    }

    public function store(MapCreateRequest $request): MapResource
    {
        $map = $this->shopService->createCurrentUserShopMap(
            $request->validated()
        );

        return new MapResource($map);
    }

    public function update(MapCreateRequest $request, Map $map): MapResource
    {
        $map = $this->shopService->updateCurrentUserShopMap(
            $map,
            $request->validated()
        );

        return new MapResource($map);
    }

    public function destroy(Map $map): MapResource
    {
        $map = $this->shopService->deleteCurrentUserShopMap($map);

        return new MapResource($map);
    }
}
