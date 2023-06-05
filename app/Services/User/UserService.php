<?php

namespace App\Services\User;

use App\Models\Invite;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly RoleRepositoryInterface $roleRepository,
        protected readonly InviteRepositoryInterface $inviteRepository,
        protected readonly ShopRepositoryInterface $shopRepository,
        protected readonly AuthManager $authManager,
    ) {
    }

    public function registerUser(array $data): User
    {
        $role = $this->roleRepository->findRoleByName(Role::MERCHANT);
        $shop = $this->shopRepository->createShop($data);

        $user = $this->userRepository->storeUser($data);
        $this->userRepository->setUserRole($user, $role);
        $this->userRepository->setUserShop($user, $shop);

        return $this->userRepository->refreshUser($user);
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

    public function getShopUsers(): Collection
    {
        $shop = $this->authManager->guard()->user()->shop;
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

    public function getShopInvitedUsers(): Collection
    {
        $shop = $this->authManager->guard()->user()->shop;
        return $this->inviteRepository->getShopInvitedUsers($shop);
    }

    public function storeOrUpdateAdminInvite(array $data): Invite|false
    {
        $admin_role = $this->findRoleByName(Role::ADMIN);
        if (!$admin_role && !isset($admin_role->id)) {
            return false;
        }
        $data['role_id'] = $admin_role->id;
        return $this->storeOrUpdateInvite($data);
    }

    public function storeOrUpdateUserInvite(array $data): Invite|false
    {
        $shop = $this->authManager->guard()->user()->shop;
        if (!$shop && !isset($shop->id)) {
            return false;
        }
        $data['shop_id'] = $shop->id;
        return $this->storeOrUpdateInvite($data);
    }

    public function storeOrUpdateInvite(array $data): Invite
    {
        return $this->inviteRepository->storeOrUpdateInvite([
            'email' => $data['email'],
            'token' => Str::uuid(),
            'role_id' => $data['role_id'],
            'shop_id' => (isset($data['shop_id']) ? $data['shop_id'] : null)
        ]);
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
