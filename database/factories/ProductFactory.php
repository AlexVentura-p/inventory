<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['RegularProduct','DigitalProduct']),
            'title' => $this->faker->unique()->word,
            'description' => $this->faker->text(100),
            'unit_price' => $this->faker->numberBetween(1,500),
            'is_visible' => $this->faker->randomElement([0,1])
        ];
    }
}
