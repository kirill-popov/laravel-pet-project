<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()
            ->count(3)
            ->state(new Sequence(
                ['role' => 'admin'],
                ['role' => 'owner'],
                ['role' => 'staff']
            ))
            ->create();
    }
}
