<?php

namespace App\Services\Auth;

use App\Http\Resources\AuthTokenResorce;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly AuthRepositoryInterface $authRepository,
    ) {
    }

    public function login(array $data): AuthTokenResorce
    {
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])) {
            $user = $this->userRepository->findUserByEmail($data['email']);
            return new AuthTokenResorce($this->authRepository->createToken($user, $data['device_name']));
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.']
        ]);
    }

    public function logout(User $user)
    {
        return $this->authRepository->deleteCurrentToken($user);
    }
}
