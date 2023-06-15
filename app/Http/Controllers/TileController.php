<?php

namespace App\Http\Controllers;

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
        return new TileResource($tile);
    }
}
