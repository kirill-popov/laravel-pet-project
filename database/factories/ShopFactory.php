<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
        ];
    }

    // public function configure()
    // {
        // return $this->afterCreating(function (Shop $shop) {
        //     Location::factory()->count(rand(1, 3))->create([
        //         'shop_id' => $shop->id,
        //         'name' => $shop->name . ' - ' . $this->faker->words(3, true),
        //     ]);
        // });
    // }
}
