<?php

namespace App\Services\User;

use App\Http\Resources\AuthTokenResorce;
use App\Models\Invite;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function registerUser(array $data): User;
    public function allUsers(): Collection;
    public function storeUser(array $data): User;
    public function findUser($id): User;
    public function findUserByEmail(string $email): User;
    public function getAdmins(): Collection;
    public function getShopUsers(): Collection;
    public function updateUser($data, $id): User;
    public function destroyUser($id): User;

    public function allRoles(): Collection;
    public function findRoleById(int $id): Role;
    public function findRoleByName(string $name): Role;

    public function getInviteAdmins(): Collection;
    public function getShopInvitedUsers(): Collection;
    public function storeOrUpdateAdminInvite(array $data): Invite|false;
    public function storeOrUpdateUserInvite(array $data): Invite|false;
    public function storeOrUpdateInvite(array $data): Invite;
    public function findInviteByToken(string $token): Invite|null;
    public function acceptInviteAndLogin(Invite $invite, array $data): AuthTokenResorce;
    public function destroyInvite(Invite $invite): Invite;
}
