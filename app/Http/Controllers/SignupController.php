<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Services\Shop\ShopService;
use App\Services\User\UserService;

class SignupController extends Controller
{
    public function __construct(
        protected readonly ShopService $shopService,
        protected readonly UserService $userService,
    ) {
    }

    public function signup(SignupRequest $request): User
    {
        $fields = $request->validated();

        $shop_res = $this->shopService->createShop($fields);

        $user_fields = array_merge($fields, [
            'role_id' => $this->userService->findRoleByName('merchant')->id,
            'shop_id' => $shop_res->id
        ]);
        $user_res = $this->userService->storeUser($user_fields);

        return $user_res;
    }
}
