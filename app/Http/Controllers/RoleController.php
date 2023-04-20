<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Arr;

class RoleController extends Controller
{
    public static function findByRole(string $role): Role
    {
        return Role::where('role', '=', $role)->first();
    }

    public static function getAll(): array
    {
        return Arr::flatten(Role::all('role')->toArray());
    }
}
