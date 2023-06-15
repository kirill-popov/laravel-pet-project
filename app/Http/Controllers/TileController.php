<?php

namespace App\Http\Controllers;

use App\Http\Resources\TileCollection;
use App\Models\Tile;
use App\Services\Shop\ShopService;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class TileController extends Controller
{
    public function __construct(
        protected readonly AuthManager $authManager,
        protected readonly ShopService $shopService,
    ) {
    }

    public function index()
    {
        $shop = $this->authManager->guard()->user()->shop;
        $tiles = $this->shopService->getShopTiles($shop);

        return new TileCollection(
            $tiles
        );
    }

    public function show(Request $request, Tile $tile)
    {
        if ($request->is('api/*')) {
            return $tile->load([
                'shop'
            ]);
        }
    }
}
