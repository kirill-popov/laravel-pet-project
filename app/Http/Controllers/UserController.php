<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService
    )
    {
    }

    public function index(Request $request)
    {
        $shop = $request->user()->shop;
        return new UserCollection($this->userService->getShopUsers($shop));
    }

    public function indexInvited(Request $request, InviteRepositoryInterface $inviteRepository)
    {
        $shop = $request->user()->shop;
        return new UserCollection($inviteRepository->getShopInvitedUsers($shop));
    }

    public function adminsIndex()
    {
        return new UserCollection($this->userService->getAdmins());
    }

    public function adminsInvitedIndex(InviteRepositoryInterface $inviteRepository)
    {
        return new UserCollection($inviteRepository->getAdmins());
    }
}
