<?php

namespace App\Services\Auth;

use App\Http\Resources\AuthTokenResorce;
use App\Models\User;

interface AuthServiceInterface
{
    public function login(array $data): AuthTokenResorce;
    public function logout(User $user);
}
