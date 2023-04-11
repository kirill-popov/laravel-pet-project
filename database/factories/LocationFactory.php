<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Prefecture;
use App\Models\Social;
use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'prefecture_id'=> $this->faker->randomElement(Prefecture::all())->id,
            'address' => $this->faker->address(),
            'address2' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'business_hours_start' => $this->faker->time(),
            'business_hours_end' => $this->faker->time(),
            'description' => $this->faker->text(150)
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Location $location) {
    //         Social::factory()->create(['location_id' => $location->id]);
    //     });
    // }
}
