<?php

namespace App\Http\Controllers;

use App\Http\Requests\TileCreateRequest;
use App\Http\Resources\TileCollection;
use App\Http\Resources\TileResource;
use App\Models\Tile;
use App\Services\Shop\ShopServiceInterface;
use Illuminate\Auth\AuthManager;

class TileController extends Controller
{
    public function __construct(
        protected readonly AuthManager $authManager,
        protected readonly ShopServiceInterface $shopService,
    ) {
    }

    public function index()
    {
        $shop = $this->authManager->guard()->user()->shop;
        $tiles = $this->shopService->getShopTiles($shop);

        return new TileCollection($tiles);
    }

    public function show(Tile $tile)
    {
        return new TileResource(
            $this->shopService->getShopTile($tile)
        );
    }

    public function store(TileCreateRequest $request)
    {
        $tile = $this->shopService->createShopTile($request->validated());

        return new TileResource($tile);
    }

    public function update(TileCreateRequest $request, Tile $tile)
    {
        $tile = $this->shopService->updateShopTile($tile, $request->validated());

        return new TileResource($tile);
    }

    public function destroy(Tile $tile)
    {
        $tile = $this->shopService->deleteShopTile($tile);

        return new TileResource($tile);
    }
}
