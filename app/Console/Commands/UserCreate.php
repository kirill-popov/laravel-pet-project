<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Services\User\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected readonly UserService $userService,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email_option = $this->option('email');
        if (!empty($email_option)) {
            $email = $email_option;
        } else {
            $email = $this->ask('Email');
        }
        $password = $this->secret('Password (leave empty to generate automatically)');
        $role_choice = $this->choice(
            'Role',
            $this->userService->allRoles()->map(function (Role $item, int $key) {
                return $item->role;
            })->toArray(),
            'owner'
        );
        $shop_id = $this->ask('Existing Shop ID (default null)');

        $role = $this->userService->findRoleByName($role_choice);
        if (empty($role->id)) {
            $this->error('Wrong Role selected.');
            return 0;
        }

        if (empty($password)) {
            $password = Str::random(10);
            $this->info('Password is: ' . $password);
        }

        $data = [
            'email' => $email,
            'password' => $password,
            'shop_id' => !is_null($shop_id) ? $shop_id : null,
            'role_id' => $role->id
        ];

        if (false === $this->userService->storeUser($data)) {
            $this->error('User not created.');
            return 0;
        }

        $this->info('User created.');
        return 0;
    }
}
