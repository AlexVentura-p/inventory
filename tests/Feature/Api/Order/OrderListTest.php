<?php

namespace Api\Order;

use App\Http\Services\RateConverter\RateConverter;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\Fakes\FakeEURConverter;
use Tests\TestCase;
use Throwable;

class OrderListTest extends TestCase
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
     * @throws Throwable
     */
    public function test_customer_user_can_get_only_their_own_orders()
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

    public function test_order_list_view_for_admin_displays_usd_and_eur()
    {
        $user = Passport::actingAs(
            User::factory()->create([
                'role' => 'customer'
            ])
        );

        Order::factory()->create([
            'user_id' => $user->id,
            'grand_total' => 90
        ]);

        $admin = Passport::actingAs(
            User::factory()->create([
                'role' => 'admin'
            ])
        );

        $response = $this->actingAs($admin)->get('orders/');

        $response->assertSeeText('90 USD');
        $response->assertSeeText('91 EUR');
    }

    public function test_customer_can_not_access_orders_page_for_admins()
    {
        $user = Passport::actingAs(
            User::factory()->create([
                'role' => 'customer'
            ])
        );

        $response = $this->actingAs($user)->get('orders/');

        $response->assertForbidden();
    }

    public function test_unauthenticated_user_can_not_access_orders_page_for_admins()
    {

        $response = $this->get('orders/');

        $response->assertRedirect('/login');
    }




}
