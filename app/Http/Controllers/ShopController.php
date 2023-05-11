<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopCollection;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Services\Shop\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        protected readonly ShopService $shopService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->shopService->setShopsOrder('name', 'asc')->allShopsPaginated();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new ShopResource(
            $this->shopRepository->createShop($request->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return new ShopResource(
            $this->shopService->getShop($shop)
        );
    }

    public function search(string $name)
    {
        return new ShopCollection(
            $this->shopService->findShopByNamePaginate($name)
        );
    }
}
