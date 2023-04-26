<?php

namespace App\Repositories\Interfaces;

interface InviteRepositoryInterface
{
    public function storeOrUpdateInvite(array $data);
    public function findInvite(string $email, string $token);
    public function destroyInvite($id);
}
