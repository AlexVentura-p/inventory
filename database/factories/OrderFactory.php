<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer = User::all()->where('role','=','customer')->random();
        return [
            'user_id' => $customer->id,
            'created_at' => $this->faker->dateTimeBetween('-10 years','now')
        ];
    }
}
