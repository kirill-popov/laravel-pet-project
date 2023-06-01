<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopCreateRequest;
use App\Http\Resources\ShopCollection;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Services\Shop\ShopService;
use Illuminate\Contracts\Pagination\Paginator;

class ShopController extends Controller
{
    public function __construct(
        protected readonly ShopService $shopService,
    ) {
    }

    public function index(): Paginator
    {
        return $this->shopService->getPaginatedShops();
    }

    public function store(ShopCreateRequest $request): ShopResource
    {
        return new ShopResource(
            $this->shopService->createShop($request->validated())
        );
    }

    public function show(Shop $shop): ShopResource
    {
        return new ShopResource($shop);
    }

    public function search(string $name): ShopCollection
    {
        return new ShopCollection(
            $this->shopService->findShopByNamePaginate($name)
        );
    }
}
