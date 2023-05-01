<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;

interface UserRepositoryInterface
{
    public function allUsers();
    public function storeUser(array $data);
    public function findUser($id);
    public function findUserByEmail(string $email);
    public function getAdmins();
    public function getShopUsers(Shop $shop);
    public function updateUser($data, $id);
    public function destroyUser($id);
}
