<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Services\User\UserService;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService
    ) {
    }

    public function index(Request $request, AuthManager $authManager)
    {
        $shop = $request->user()->shop;
        return new UserCollection($this->userService->getShopUsers($shop));
    }

    public function indexInvited(Request $request)
    {
        $shop = $request->user()->shop;
        return new UserCollection($this->userService->getShopInvitedUsers($shop));
    }

    public function adminsIndex()
    {
        return new UserCollection($this->userService->getAdmins());
    }

    public function adminsInvitedIndex()
    {
        return new UserCollection($this->userService->getAdmins());
    }
}
