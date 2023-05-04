<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\Interfaces\SocialsRepositoryInterface;
use App\Services\Shop\ShopService;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    protected $locationRepository;
    protected $socialsRepository;

    public function __construct(
        protected readonly ShopService $shopService,
        LocationRepositoryInterface $locationRepository,
        SocialsRepositoryInterface $socialsRepository
    ) {
        $this->locationRepository = $locationRepository;
        $this->socialsRepository = $socialsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop = $request->user()->shop;

        return new LocationCollection(
            $this->shopService->getShopLocations($shop)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationFormRequest $request)
    {
        $data = $request->validated();
        $data['shop_id'] = $request->user()->shop->id;
        $location = $this->locationRepository->storeLocation($data);
        // $location->socials()->save($data);
        $this->socialsRepository->storeSocials($data, $location);
        return $location->fresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return new LocationResource($this->shopService->viewLocation($location));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
