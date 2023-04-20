<?php

namespace App\Console\Commands;

use App\Http\Controllers\RoleController;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
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
    public function __construct()
    {
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
        $user_name = $this->ask('User Name (default null)');
        $password = $this->secret('Password (leave empty to generate automatically)');
        $role_choice = $this->choice(
            'Role',
            RoleController::getAll(),
            'owner'
        );
        $status = $this->choice(
            'Status',
            ['active', 'invited'],
            'active'
        );
        $shop_id = $this->ask('Shop ID (default null)');

        $roleObj = RoleController::findByRole($role_choice);
        if (!is_a($roleObj, 'App\Models\Role')) {
            $this->error('Wrong Role selected.');
            return 0;
        }

        if (empty($password)) {
            $password = Str::random(10);
            $this->info('Password is: ' . $password);
        }

        $user = new User();
        $user->name = !empty($user_name) ? $user_name : null;
        $user->email = $email_option;
        $user->password = Hash::make($password);
        $user->shop_id = !is_null($shop_id) ? $shop_id : null;
        $user->role_id = $roleObj->id;
        $user->status = $status;
        $user->save();
        $this->info('User created.');
        return 0;
    }
}
