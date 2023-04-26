<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class SignupController extends Controller
{
    protected $shopRepository;
    protected $userRepository;
    protected $roleRepository;

    public function __construct(
        ShopRepositoryInterface $shopRepository,
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

        $shop_res = $this->shopRepository->createShop($fields);

        $user_fields = array_merge($fields, [
            'role_id' => $this->roleRepository->findRoleByName('merchant')->id,
            'shop_id' => $shop_res->id
        ]);
        $user_res = $this->userRepository->storeUser($user_fields);

        return $user_res;
    }
}
