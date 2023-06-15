<?php

namespace Database\Factories;

use App\Models\Tile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([Tile::SIZE_SM, Tile::SIZE_MD, Tile::SIZE_LG, Tile::SIZE_XL]),
            'link_to' => $this->faker->url,
            'title' => $this->faker->words(rand(2, 5), true),
            'subtitle' => $this->faker->words(rand(5, 10), true),
            'img_url' => $this->faker->imageUrl,
            'img_only' => rand(0, 1)
        ];
    }
}
