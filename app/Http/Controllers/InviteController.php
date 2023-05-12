<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteSignupRequest;
use App\Http\Resources\InviteAutofillResource;
use App\Mail\AdminInviteEmail;
use App\Mail\UserInviteEmail;
use Illuminate\Support\Str;
use App\Services\User\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    ) {
    }

    public function inviteAdmin(InviteRequest $request): Response
    {
        $admin_role = $this->userService->findRoleByName('admin');
        $invite = $this->userService->storeOrUpdateInvite([
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

        $invite = $this->userService->storeOrUpdateInvite([
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
        $invite = $this->userService->findInvite($id, $token);
        return new InviteAutofillResource($invite);
    }

    public function accept(InviteSignupRequest $request, int $id, string $token): Response
    {
        $invite = $this->userService->findInvite($id, $token);
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
        $this->userService->storeUser($data);
        $this->userService->destroyInvite($invite);

        return response(['message'=>'Success'], 200);
    }
}
