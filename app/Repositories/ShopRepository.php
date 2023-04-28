<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\ShopRepositoryInterface;

class ShopRepository implements ShopRepositoryInterface
{
    protected $order_by = 'name';
    protected $order = 'asc';

    public function setOrder(string $order_by, string $order)
    {
        $this->order_by = $order_by;
        $this->order = $order;
        return $this;
    }

    public function allShops()
    {
        return Shop::orderBy($this->order_by, $this->order)->paginate(10);
    }

    public function findShop(int $id)
    {
        return Shop::find($id);
    }

    public function createShop(array $data)
    {
        return Shop::create([
            'name' => $data['shop_name']
        ]);
    }
}
