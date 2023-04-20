<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;

interface RoleRepositoryInterface
{
    public function allRoles();
    public function findRoleById(int $id): Role;
    public function findRoleByName(string $name): Role;
}
