<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class ShopRepository implements ShopRepositoryInterface
{
    protected $order_by = 'name';
    protected $order = 'asc';

    public function setOrder(string $order_by, string $order): ShopRepository
    {
        $this->order_by = $order_by;
        $this->order = $order;
        return $this;
    }

    public function allShops(): Collection
    {
        return Shop::orderBy($this->order_by, $this->order)->get();
    }

    public function allShopsPaginated(int $count = 10): Paginator
    {
        return Shop::orderBy($this->order_by, $this->order)->paginate($count);
    }

    public function getShop(Shop $shop): Shop
    {
        return $shop;
    }

    public function findByName(string $name): Collection
    {
        return Shop::where('name', 'like', $name.'%')
            ->orderBy($this->order_by, $this->order)
            ->get();
    }

    public function findByNamePaginate(string $name, int $count = 10): Paginator
    {
        return Shop::where('name', 'like', $name.'%')
            ->orderBy($this->order_by, $this->order)
            ->paginate($count);
    }

    public function createShop(array $data): Shop
    {
        return Shop::create([
            'name' => $data['shop_name']
        ]);
    }
}
