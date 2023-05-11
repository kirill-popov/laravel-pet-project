<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers(): Collection
    {
        return User::all()->paginate(10);
    }

    /**
     * Inserts new user and returns
     *
     * @param array $data
     * @return App\Model\User or boolean
     */
    public function storeUser(array $data): User
    {
        return User::create($data);
    }

    public function findUser($id): User
    {
        return User::find($id);
    }

    public function findUserByEmail(string $email): User
    {
        return User::firstWhere('email', $email);
    }

    public function getAdmins(): Collection
    {
        return User::admins()->paginate(10);
    }

    public function getShopUsers(Shop $shop): Collection
    {
        return User::shopUsers($shop)->paginate(10);
    }

    public function updateUser($data, $id): User
    {
        $user = User::where('id', $id)->first();
        $user->save();
        return $user;
    }

    public function destroyUser($id): User
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}
