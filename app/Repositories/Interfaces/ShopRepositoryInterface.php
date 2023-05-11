<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface ShopRepositoryInterface
{
    public function setOrder(string $order_by, string $order);
    public function allShops(): Collection;
    public function allShopsPaginated(int $count = 10): Paginator;
    public function getShop(Shop $shop): Shop;
    public function findByName(string $name): Collection;
    public function findByNamePaginate(string $name): Paginator;
    public function createShop(array $data): Shop;
}
