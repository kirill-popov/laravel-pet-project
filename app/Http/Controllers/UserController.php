<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService
    ) {
    }

    public function index()
    {
        return new UserCollection($this->userService->getShopUsers());
    }

    public function indexInvited()
    {
        return new UserCollection($this->userService->getShopInvitedUsers());
    }

    public function adminsIndex()
    {
        return new UserCollection($this->userService->getAdmins());
    }

    public function adminsInvitedIndex()
    {
        return new UserCollection($this->userService->getInvitedAdmins());
    }
}
