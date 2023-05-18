<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface AuthRepositoryInterface
{
    public function createToken(User $user, string $device_name): NewAccessToken;
    public function deleteCurrentToken(User $user);
}
