<?php

namespace Api\Order;

use App\Http\Services\RateConverter\RateConverter;
use App\Models\LineItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Mockery;
use Mockery\MockInterface;
use Tests\Fakes\FakeEURConverter;
use Tests\TestCase;

class OrderDetailTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->bind(RateConverter::class, FakeEURConverter::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function test_order_detail_endpoint_for_user_gets_usd_and_eur_totals()
    {
        $user = Passport::actingAs(
            User::factory()->create([
                'role' => 'customer'
            ])
        );

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'grand_total' => 90
        ]);


        $response = $this->actingAs($user)->getJson('api/customer/orders/' . $order->id);


        $response->assertJsonFragment([
            'grand total USD' =>90,
            'grand total EUR' =>91
        ]);
    }


}
