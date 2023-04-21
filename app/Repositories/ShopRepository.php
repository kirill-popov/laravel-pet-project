<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\ShopRepositoryInterface;

class ShopRepository implements ShopRepositoryInterface
{
    public function allShops()
    {
        return Shop::latest()->paginate(10);
    }

    public function findShop(int $id)
    {
        return Shop::find($id);
    }

    public function createShop(array $data)
    {
        return Shop::create([
            'name' => $data['name']
        ]);
    }
    public function updateShop(int $id, array $data)
    {

    }

    public function deleteShop(int $id)
    {

    }
}
