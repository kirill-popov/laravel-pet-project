<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Shop;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
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
        return User::admins()->get();
    }

    public function getAdminsPaginated(): Paginator
    {
        return User::admins()->paginate(10);
    }

    public function getShopUsers(Shop $shop): Collection
    {
        return User::shopUsers($shop)->all();
    }

    public function getShopUsersPaginated(Shop $shop): Paginator
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

    public function setUserRole(User $user, Role $role): User
    {
        $user->role_id = $role->id;
        $user->save();
        return $user;
    }

    public function setUserShop(User $user, Shop $shop): User
    {
        $user->shop_id = $shop->id;
        $user->save();
        return $user;
    }

    public function refreshUser(User $user): User
    {
        return $user->refresh();
    }
}
