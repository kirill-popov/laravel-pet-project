<?php

namespace Database\Factories;

use App\Models\Prefecture;
use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'status' => $this->faker->numberBetween(0, 1),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'zip' => Address::postcode(),
            'prefecture_id'=> Prefecture::factory(),
            'address' => $this->faker->address(),
            'address2' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'business_hours_start' => $this->faker->time(),
            'business_hours_end' => $this->faker->time(),
            'description' => $this->faker->text(150)
        ];
    }
}
