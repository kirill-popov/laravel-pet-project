<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function allUsers();
    public function storeUser(array $data);
    public function findUser($id);
    public function findUserByEmail(string $email);
    public function updateUser($data, $id);
    public function destroyUser($id);
}
