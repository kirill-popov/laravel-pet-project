<?php

namespace App\Repositories\Interfaces;

interface ShopRepositoryInterface
{
    public function setOrder(string $order_by, string $order);
    public function allShops();
    public function findShop(int $id);
    public function createShop(array $data);
}
