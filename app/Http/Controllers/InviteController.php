<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteSignupRequest;
use App\Http\Resources\InviteAutofillResource;
use App\Mail\AdminInviteEmail;
use App\Mail\UserInviteEmail;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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

    public function inviteAdmin(InviteRequest $request): Response
    {
        $admin_role = $this->roleRepository->findRoleByName('admin');
        $invite = $this->inviteRepository->storeOrUpdateInvite([
            'email' => $request->input('email'),
            'token' => Str::uuid(),
            'role_id' => $admin_role->id
        ]);
        if ($invite) {
            Mail::to($invite->email)->send(new AdminInviteEmail($invite));
            return response(['message'=>'Invitation sent.'], 200);
        }
    }

    public function inviteUser(InviteRequest $request): Response
    {
        $shop = $request->user()->shop;

        $invite = $this->inviteRepository->storeOrUpdateInvite([
            'email' => $request->input('email'),
            'token' => Str::uuid()->toString(),
            'role_id' => $request->input('role_id'),
            'shop_id' => ($shop ? $shop->id : null)
        ]);

        if ($invite) {
            Mail::to($invite->email)->send(new UserInviteEmail($invite));
        }

        return response(['message'=>'Invitation sent.'], 200);
    }

    public function view_prefill_data(int $id, string $token)
    {
        $invite = $this->inviteRepository->findInvite($id, $token);
        return new InviteAutofillResource($invite);
    }

    public function accept(InviteSignupRequest $request, int $id, string $token): Response
    {
        $invite = $this->inviteRepository->findInvite($id, $token);
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
        $this->userRepository->storeUser($data);
        $this->inviteRepository->destroyInvite($invite->id);

        return response(['message'=>'Success'], 200);
    }
}
