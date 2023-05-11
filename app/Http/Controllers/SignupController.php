<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Shop\ShopService;

class SignupController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(
        protected readonly ShopService $shopService,
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository
    ) {
        $this->shopRepository = $shopRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function signup(SignupRequest $request): User
    {
        $fields = $request->validated();

        $shop_res = $this->shopService->createShop($fields);

        $user_fields = array_merge($fields, [
            'role_id' => $this->roleRepository->findRoleByName('merchant')->id,
            'shop_id' => $shop_res->id
        ]);
        $user_res = $this->userRepository->storeUser($user_fields);

        return $user_res;
    }
}
