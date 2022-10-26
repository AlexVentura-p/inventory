<?php

namespace Api\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserInfoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_authenticated_user_can_get_profile_info()
    {

        $guestResponse = $this->getJson('/api/user');

        $customer = Passport::actingAs(
            User::factory()->create(['role' => 'customer',]),
            ['api']
        );

        $admin = Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );


        $customerResponse = $this->actingAs($customer)
            ->getJson('/api/user');

        $adminResponse = $this->actingAs($admin)
            ->getJson('/api/user');



        $guestResponse->assertStatus(401);
        $customerResponse->assertStatus(200);
        $adminResponse->assertStatus(200);
    }
}
