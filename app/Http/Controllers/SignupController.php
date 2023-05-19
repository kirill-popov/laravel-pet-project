<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Services\Shop\ShopService;
use App\Services\User\UserService;

class SignupController extends Controller
{
    public function __construct(
        protected readonly ShopService $shopService,
        protected readonly UserService $userService,
    ) {
    }

    public function signup(SignupRequest $request): UserResource
    {
        $user = $this->userService->registerUser($request->validated());
        return new UserResource($user);
    }
}
