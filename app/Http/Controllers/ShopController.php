<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ShopRepositoryInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopRepository;

    public function __construct(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->shopRepository->setOrder('name', 'asc')->allShops();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->shopRepository->createShop($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->shopRepository->findShop($id);
    }
}
