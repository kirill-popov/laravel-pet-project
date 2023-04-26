<?php

namespace App\Repositories;

use App\Models\Invite;
use App\Repositories\Interfaces\InviteRepositoryInterface;

class InviteRepository implements InviteRepositoryInterface
{
    /**
     * Inserts new user and returns
     *
     * @param array $data
     * @return App\Model\Invite or boolean
     */
    public function storeOrUpdateInvite(array $data): mixed
    {
        return Invite::updateOrCreate(
            [
                'email' => $data['email']
            ],
            $data
        );
    }

    public function findInvite(string $email, string $token)
    {
        return Invite::where('email', $email)->where('token', $token)->first();
    }

    public function destroyInvite($id)
    {
        $invite = Invite::find($id);
        $invite->delete();
    }
}
