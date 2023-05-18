<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService,
    ) {
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        return $this->authService->login($validated);
    }

    public function logout(Request $request): void
    {
        $this->authService->logout($request->user());
    }
}
