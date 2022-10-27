<?php

namespace Api\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Throwable;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Throwable
     */
    public function test_only_my_orders_are_visible()
    {

        User::factory(2)
            ->has(Order::factory()->count(5))
            ->create([
            'role'=>'customer'
        ]);

        $userTest = User::factory()
            ->has(Order::factory()->count(3))
            ->create([
                'role'=>'customer'
            ]);

        Passport::actingAs($userTest);

        $response = $this->getJson('/api/customer/orders');
        $data = $response->decodeResponseJson()['data'];
        $userIdCollection = array_column($data, 'user_id');

        $this->assertEquals([$userTest->id], array_unique($userIdCollection));

    }


}
