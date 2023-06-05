<?php

namespace App\Repositories;

use App\Models\Invite;
use App\Models\Shop;
use App\Repositories\Interfaces\InviteRepositoryInterface;

class InviteRepository implements InviteRepositoryInterface
{
    public function getAdmins()
    {
        return Invite::admins()->paginate(10);
    }

    public function getShopInvitedUsers(Shop $shop)
    {
        return Invite::shopInvites($shop)->orderBy('email', 'asc')->paginate(10);
    }

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

    public function findByToken(string $token)
    {
        return Invite::where('token', $token)->first();
    }

    public function destroyInvite(Invite $invite): Invite
    {
        $invite->delete();
        return $invite;
    }
}
