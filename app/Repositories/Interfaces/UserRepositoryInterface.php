<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function allUsers(): Collection;
    public function storeUser(array $data): User;
    public function findUser($id): User;
    public function findUserByEmail(string $email): User;
    public function getAdmins(): Collection;
    public function getShopUsers(Shop $shop): Collection;
    public function updateUser($data, $id): User;
    public function destroyUser($id): User;
}
