<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\LineItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Product::factory(20)->create();
        Category::factory(5)->create();
        Order::factory(10)
            ->has(LineItem::factory()->count(2))
            ->create();
        foreach (Order::all() as $order){
            $order->updateTotals();
        }



        User::factory()->create([
            'first_name' => 'alex',
            'last_name' => 'ventura',
            'email' => 'av@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);

    }
}
