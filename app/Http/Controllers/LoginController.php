<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    ) {
    }

    public function login(LoginRequest $request): array
    {
        $validated = $request->validated();
        $user = $this->userService->findUserByEmail($validated['email']);
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'token' => $user->createToken($request->device_name)->plainTextToken
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
