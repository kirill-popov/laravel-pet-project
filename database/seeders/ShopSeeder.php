<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Map;
use App\Models\Role;
use App\Models\Shop;
use App\Models\Tile;
use App\Models\User;
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
                User::factory()
                    ->state(function (array $attributes) {
                        return [
                            'role_id' => Role::all()->where('role', '=', Role::MERCHANT)->first()->id
                        ];
                    })
            )
            ->has(
                Location::factory()
                    ->state(function (array $attributes, Shop $shop) {
                        return ['name' => $shop->name . ' - Main Store'];
                    })
            )
            ->has(
                Location::factory()
                    ->count(2)
                    ->state(function (array $attributes, Shop $shop) {
                        $faker = app(Generator::class);
                        return ['name' => $shop->name . ' - ' . $faker->words(2, true)];
                    })
            )
            ->has(
                Map::factory()
                ->state(function (array $attributes, Shop $shop) {
                    $faker = app(Generator::class);
                    return [
                        'shop_id' => $shop->id,
                        'default_location_id' => Location::where('shop_id', '=', $shop->id)->get()->random()->id
                    ];
                })
            )
            ->has(
                Tile::factory()
                ->state(function (array $attributes, Shop $shop) {
                    return [
                        'shop_id' => $shop->id
                    ];
                })
            )
            ->create();
    }
}
