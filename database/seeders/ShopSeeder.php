<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Faker\Generator;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::debug('ShopSeeder');
        Shop::factory()
            ->count(20)
            ->has(
                Location::factory()
                    ->state(function(array $attributes, Shop $shop) {
                        return ['name' => $shop->name . ' - Main Store'];
                    })
            )
            ->has(
                Location::factory()
                    ->count(2)
                    ->state(function(array $attributes, Shop $shop) {
                        $faker = app(Generator::class);
                        return ['name' => $shop->name . ' - ' . $faker->words(2, true)];
                    })
            )
            ->create();
    }
}
