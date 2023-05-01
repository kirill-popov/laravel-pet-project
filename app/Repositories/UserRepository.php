<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::all()->paginate(10);
    }

    /**
     * Inserts new user and returns
     *
     * @param array $data
     * @return App\Model\User or boolean
     */
    public function storeUser(array $data): mixed
    {
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function findUserByEmail(string $email)
    {
        return User::firstWhere('email', $email);
    }

    public function getAdmins()
    {
        return User::admins()->paginate(10);
    }

    public function updateUser($data, $id)
    {
        $category = User::where('id', $id)->first();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->save();
    }

    public function destroyUser($id)
    {
        $category = User::find($id);
        $category->delete();
    }
}
