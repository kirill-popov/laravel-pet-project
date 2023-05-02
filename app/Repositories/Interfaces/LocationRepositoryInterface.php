<?php

namespace App\Repositories\Interfaces;

interface LocationRepositoryInterface
{
    public function shopLocations(int $shop_id);
    public function storeLocation(array $data);
    public function viewLocation(int $id);
    public function updateLocation($data, $id);
    public function destroyLocation($id);
}
