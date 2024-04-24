<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_place'=>$this->faker->name(),
            'info'=>$this->faker->address(),
            'country_id'=>$this->faker->numberBetween('1','10'),
            'city_id'=>$this->faker->numberBetween('1','10')
        ];
    }
}
