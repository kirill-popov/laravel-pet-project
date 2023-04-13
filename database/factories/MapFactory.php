<?php

namespace Database\Factories;

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
            'style' => $this->faker->randomElement(['md', 'lg']),
            'status' => 0
        ];
    }
}
