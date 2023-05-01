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

    public function store(Request $request)
    {

    }

    public function adminsIndex()
    {
        return new UserCollection($this->userRepository->getAdmins());
    }

    // public function adminsInvitedIndex(InviteRepositoryInterface $inviteRepository)
    // {
    //     return new UserCollection($inviteRepository->getAdmins());
    // }
}
