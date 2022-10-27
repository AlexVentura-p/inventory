<?php

namespace Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserInfoTest extends TestCase
{
    use DatabaseTransactions;
    /**
     *
     * @return void
     */
    public function test_unauthenticated_user_can_not_get_profile_info()
    {
        $response = $this->getJson('/api/user');

        $response->assertUnauthorized();
    }

    /**
     * @dataProvider  rolesData
     */
    public function test_authenticated_user_can_get_profile_info($role)
    {
        $user = Passport::actingAs(
            User::factory()->create(['role' => $role,]),
            ['api']
        );

        $response = $this->actingAs($user)
            ->getJson('/api/user');

        $response->assertOk();
    }

    public function rolesData(): array
    {
        return [
            ['admin'],
            ['customer']
        ];
    }
}
