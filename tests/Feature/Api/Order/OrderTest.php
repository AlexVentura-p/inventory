<?php

namespace Api\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $userTest = Passport::actingAs(
            User::factory()->create(['role' => 'customer',]),
            ['api']
        );

        Order::factory(5)->create([
            'user_id' => $userTest->id
        ]);

        $userTwo = Passport::actingAs(
            User::factory()->create(['role' => 'customer',]),
            ['api']
        );

        Order::factory(3)->create([
            'user_id' => $userTwo->id
        ]);


        $response = $this->actingAs($userTest)->getJson('/api/customer/orders');
        $array = $response->decodeResponseJson()['data'];
        $userIdCollection = array_column($array, 'user_id');

        $this->assertCount(1, array_unique($userIdCollection));
    }
}
