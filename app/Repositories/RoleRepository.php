<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function allRoles()
    {
        return Role::all();
    }

    public function findRoleById(int $id): Role
    {
        return Role::where('id', '=', $id)->first();
    }

    public function findRoleByName(string $name): Role
    {
        return Role::where('role', '=', $name)->first();
    }
}
