<?php

namespace App\Services\User;

use App\Models\Invite;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly RoleRepositoryInterface $roleRepository,
        protected readonly InviteRepositoryInterface $inviteRepository,
    ) {
    }

    public function allUsers(): Collection
    {
        return $this->userRepository->allUsers();
    }

    public function storeUser(array $data): User
    {
        return $this->userRepository->storeUser($data);
    }

    public function findUser($id): User
    {
        return $this->userRepository->findUser($id);
    }

    public function findUserByEmail(string $email): User
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function getAdmins(): Collection
    {
        return $this->userRepository->getAdmins();
    }

    public function getShopUsers(Shop $shop): Collection
    {
        return $this->userRepository->getShopUsers($shop);
    }

    public function updateUser($data, $id): User
    {
        return $this->userRepository->updateUser($data, $id);
    }

    public function destroyUser($id): User
    {
        return $this->userRepository->destroyUser($id);
    }


    public function allRoles(): Collection
    {
        return $this->roleRepository->allRoles();
    }

    public function findRoleById(int $id): Role
    {
        return $this->roleRepository->findRoleById($id);
    }

    public function findRoleByName(string $name): Role
    {
        return $this->roleRepository->findRoleByName($name);
    }


    public function getInviteAdmins(): Collection
    {
        return $this->inviteRepository->getAdmins();
    }

    public function getShopInvitedUsers(Shop $shop): Collection
    {
        return $this->inviteRepository->getShopInvitedUsers($shop);
    }

    public function storeOrUpdateInvite(array $data): Invite
    {
        return $this->inviteRepository->storeOrUpdateInvite($data);
    }

    public function findInvite(int $id, string $token): Invite
    {
        return $this->inviteRepository->findInvite($id, $token);
    }

    public function destroyInvite(Invite $invite): Invite
    {
        return $this->inviteRepository->destroyInvite($invite);
    }
}