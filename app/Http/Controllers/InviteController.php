<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteSignupRequest;
use App\Http\Resources\InviteAutofillResource;
use App\Mail\AdminInviteEmail;
use App\Mail\UserInviteEmail;
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
        $invite = $this->userService->storeOrUpdateAdminInvite(
            $request->validated()
        );
        if ($invite) {
            Mail::to($invite->email)->send(new AdminInviteEmail($invite));
            return response(['message'=>'Invitation sent.'], 200);
        }
        return response(['message'=>'Invitation not sent.'], 500);
    }

    public function inviteUser(InviteRequest $request): Response
    {
        $invite = $this->userService->storeOrUpdateUserInvite(
            $request->validated()
        );
        if ($invite) {
            Mail::to($invite->email)->send(new UserInviteEmail($invite));
            return response(['message'=>'Invitation sent.'], 200);
        }
        return response(['message'=>'Invitation not sent.'], 500);
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
