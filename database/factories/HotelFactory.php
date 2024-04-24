<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_name'=>$this->faker->name(),
            'info'=>$this->faker->address(),
            'photo'=>$this->faker->title(),
            'number_rate'=>$this->faker->numberBetween('1','5'),
            'number_room'=>$this->faker->numberBetween('100','300'),
            'country_id'=>$this->faker->numberBetween('1','10'),
            'city_id'=>$this->faker->numberBetween('1','10')
        ];
    }
}
