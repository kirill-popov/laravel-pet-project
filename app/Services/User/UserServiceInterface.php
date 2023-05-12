<?php

namespace App\Services\User;

use App\Models\Invite;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function allUsers(): Collection;
    public function storeUser(array $data): User;
    public function findUser($id): User;
    public function findUserByEmail(string $email): User;
    public function getAdmins(): Collection;
    public function getShopUsers(Shop $shop): Collection;
    public function updateUser($data, $id): User;
    public function destroyUser($id): User;

    public function allRoles(): Collection;
    public function findRoleById(int $id): Role;
    public function findRoleByName(string $name): Role;

    public function getInviteAdmins(): Collection;
    public function getShopInvitedUsers(Shop $shop): Collection;
    public function storeOrUpdateInvite(array $data): Invite;
    public function findInvite(int $id, string $token): Invite;
    public function destroyInvite(Invite $invite): Invite;
}
