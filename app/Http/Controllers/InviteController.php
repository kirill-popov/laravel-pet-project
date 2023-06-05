<?php

namespace App\Http\Controllers;

use App\Exceptions\InviteNotSentException;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteSignupRequest;
use App\Http\Resources\InviteAutofillResource;
use App\Http\Resources\InviteResource;
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

    public function inviteAdmin(InviteRequest $request): InviteResource
    {
        $invite = $this->userService->storeOrUpdateAdminInvite(
            $request->validated()
        );
        $mailSent = Mail::to($invite->email)->send(new AdminInviteEmail($invite));
        if (!$mailSent) {
            throw new InviteNotSentException();
        }

        return new InviteResource(
            $invite
        );
    }

    public function inviteUser(InviteRequest $request): InviteResource
    {
        $invite = $this->userService->storeOrUpdateUserInvite(
            $request->validated()
        );
        $mailSent = Mail::to($invite->email)->send(new UserInviteEmail($invite));
        if (!$mailSent) {
            throw new InviteNotSentException();
        }
        return new InviteResource(
            $invite
        );
    }

    public function viewPrefillData(int $id, string $token)
    {
        $invite = $this->userService->findInvite($id, $token);
        return new InviteAutofillResource($invite);
    }

    public function accept(InviteSignupRequest $request, int $id, string $token): Response
    {
        $invite = $this->userService->findInvite($id, $token);

        $data = array_merge(
            $request->validated(),
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
