<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapResource;
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
}
