<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'location_id' => '',
            'facebook' => (rand(0, 1) ? $this->faker->url() : null),
            'instagram' => (rand(0, 1) ? $this->faker->url() : null),
            'twitter' => (rand(0, 1) ? $this->faker->url() : null),
            'line' => (rand(0, 1) ? $this->faker->url() : null),
            'tiktok' => (rand(0, 1) ? $this->faker->url() : null),
            'youtube' => (rand(0, 1) ? $this->faker->url() : null)
        ];
    }
}
