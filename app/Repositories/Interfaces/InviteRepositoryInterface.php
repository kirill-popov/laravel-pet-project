<?php

namespace App\Repositories\Interfaces;

interface InviteRepositoryInterface
{
    public function getAdmins();
    public function storeOrUpdateInvite(array $data);
    public function findInvite(int $id, string $token);
    public function destroyInvite($id);
}
