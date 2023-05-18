<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Laravel\Sanctum\NewAccessToken;

class AuthRepository implements AuthRepositoryInterface
{
    public function createToken(User $user, string $device_name='device_name'): NewAccessToken
    {
        return $user->createToken($device_name);
    }

    public function deleteCurrentToken(User $user)
    {
        return $user->currentAccessToken()->delete();
    }
}
