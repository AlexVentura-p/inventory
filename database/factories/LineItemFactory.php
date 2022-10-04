<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::all()->random();
        $quantity = $this->faker->numberBetween(1,20);
        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $product->unit_price,
            'item_total' => $quantity * $product->unit_price
        ];
    }
}
