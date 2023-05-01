<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $shop = $request->user()->shop;
        return new UserCollection($this->userRepository->getShopUsers($shop));
    }

    public function indexInvited(Request $request, InviteRepositoryInterface $inviteRepository)
    {
        $shop = $request->user()->shop;
        return new UserCollection($inviteRepository->getShopInvitedUsers($shop));
    }

    public function adminsIndex()
    {
        return new UserCollection($this->userRepository->getAdmins());
    }

    public function adminsInvitedIndex(InviteRepositoryInterface $inviteRepository)
    {
        return new UserCollection($inviteRepository->getAdmins());
    }
}
