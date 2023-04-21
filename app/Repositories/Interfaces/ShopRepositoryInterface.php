<?php

namespace App\Repositories\Interfaces;

interface ShopRepositoryInterface
{
    public function allShops();
    public function findShop(int $id);
    public function createShop(array $data);
    public function updateShop(int $id, array $data);
    public function deleteShop(int $id);
}
