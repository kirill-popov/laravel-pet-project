<?php

namespace Database\Seeders;

use App\Models\Prefecture;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::debug('Prefectures seeder');
        Prefecture::factory()
            ->count(20)
            ->create();
    }
}
