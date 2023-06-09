<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Photo;
use App\Models\Prefecture;
use App\Models\Social;
use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => null,
            'name' => '',
            'is_enabled' => false,
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
            'workday_mon' => rand(0, 1),
            'workday_tue' => rand(0, 1),
            'workday_wed' => rand(0, 1),
            'workday_thu' => rand(0, 1),
            'workday_fri' => rand(0, 1),
            'workday_sat' => rand(0, 1),
            'workday_sun' => rand(0, 1),
            'description' => $this->faker->text(150)
        ];
    }

    public function configure()
    {
        Log::debug('LocationFactory conf');
        return $this->afterCreating(function (Location $location) {
            Social::factory()->create(['location_id' => $location->id]);
            Photo::factory()->count(rand(1, 5))->create(['location_id' => $location->id]);
        });
    }
}
