<?php

namespace App\Repositories\Interfaces;

use App\Models\Shop;

interface InviteRepositoryInterface
{
    public function getAdmins();
    public function getShopInvitedUsers(Shop $shop);
    public function storeOrUpdateInvite(array $data);
    public function findInvite(int $id, string $token);
    public function destroyInvite($id);
}
