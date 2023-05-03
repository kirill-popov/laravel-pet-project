<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Http\Resources\LocationCollection;
use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
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
            $this->locationRepository->shopLocations($shop->id)
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
        return $this->locationRepository->storeLocation($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Location $location)
    {
        return $location->load([
            'prefecture:id,title',
            'photos:location_id,is_default,url',
            'socials:location_id,facebook,instagram,twitter,line,tiktok,youtube'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
