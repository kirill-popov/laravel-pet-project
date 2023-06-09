<?php

namespace App\Repositories\Interfaces;

use App\Models\Invite;
use App\Models\Shop;

interface InviteRepositoryInterface
{
    public function getAdmins();
    public function getShopInvitedUsers(Shop $shop);
    public function storeOrUpdateInvite(array $data);
    public function findByToken(string $token);
    public function destroyInvite(Invite $invite): Invite;
}
