<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;
use App\Repositories\ShopRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface ShopRepositoryInterface
{
    public function orderByName(string $order): ShopRepository;
    public function allShops(): Collection;
    public function paginatedShops(int $count = 10): Paginator;
    public function getShop(Shop $shop): Shop;
    public function searchByNameAll(string $string): Collection;
    public function searchByNamePaginated(string $string): Paginator;
    public function createShop(array $data): Shop;
}
