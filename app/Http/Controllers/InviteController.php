<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteSignupRequest;
use App\Http\Requests\SignupRequest;
use App\Mail\AdminInviteEmail;
use App\Mail\UserInviteEmail;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InviteController extends Controller
{
    protected $inviteRepository;
    protected $roleRepository;
    protected $userRepository;

    public function __construct(
        InviteRepositoryInterface $inviteRepository,
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->inviteRepository = $inviteRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    public function inviteAdmin(InviteRequest $request)
    {
        $admin_role = $this->roleRepository->findRoleByName('admin');
        $invite = $this->inviteRepository->storeOrUpdateInvite([
            'email' => $request->input('email'),
            'token' => Str::uuid(),
            'role_id' => $admin_role->id
        ]);
        if ($invite) {
            Mail::to($invite->email)->send(new AdminInviteEmail($invite));
        }
    }

    public function inviteUser(InviteRequest $request)
    {
        $invite = $this->inviteRepository->storeOrUpdateInvite([
            'email' => $request->input('email'),
            'token' => Str::uuid(),
            'role_id' => $request->input('role_id'),
            // 'shop_id' => null, // redo this
        ]);
        if ($invite) {
            Mail::to($invite->email)->send(new UserInviteEmail());
        }
    }

    public function accept(InviteSignupRequest $request, string $email, string $token): Response
    {
        $fields = $request->all();

        $invite = $this->inviteRepository->findInvite($email, $token);
        if (!$invite) {
            return response(['message'=>'Wrong link or invitation invalid.'], 404);
        }

        $data = array_merge(
            $request->all(),
            [
                'role_id' => $invite->role_id,
                'shop_id' => $invite->shop_id
            ]
        );
        // dd($data);
        $this->userRepository->storeUser($data);

        $this->inviteRepository->destroyInvite($invite->id);

        return response(['message'=>'Success'], 200);
    }
}
