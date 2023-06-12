<?php

namespace Database\Factories;

use App\Models\Map;
use Illuminate\Database\Eloquent\Factories\Factory;

class MapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'style' => $this->faker->randomElement([Map::SIZE_MD, Map::SIZE_LG]),
            'is_enabled' => false
        ];
    }
}
