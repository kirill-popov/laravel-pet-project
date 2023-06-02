<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class ShopRepository implements ShopRepositoryInterface
{
    protected $order_by = '';
    protected $order = 'asc';

    public function __construct()
    {
        $this->order_by = 'name'; // set default sort field
    }

    private function orderBy(string $order_by, string $order): ShopRepository
    {
        $this->order_by = $order_by;
        $this->order = $order;
        return $this;
    }

    public function orderByName(string $order): ShopRepository
    {
        return $this->orderBy('name', $order);
    }

    public function allShops(): Collection
    {
        return Shop::orderBy($this->order_by, $this->order)->get();
    }

    public function paginatedShops(int $count = 10): Paginator
    {
        return Shop::orderBy($this->order_by, $this->order)->paginate($count);
    }

    public function getShop(Shop $shop): Shop
    {
        return $shop;
    }

    public function searchByNameAll(string $string): Collection
    {
        return Shop::where('name', 'like', $string.'%')
            ->orderBy($this->order_by, $this->order)
            ->get();
    }

    public function searchByNamePaginated(string $string, int $count = 10): Paginator
    {
        return Shop::where('name', 'like', $string.'%')
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
