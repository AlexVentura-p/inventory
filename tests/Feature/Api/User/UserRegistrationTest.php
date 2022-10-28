<?php

namespace Api\User;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function test_new_user_can_register()
    {
        $this->post('/register', [
            'first_name' => 'juan',
            'last_name' => 'perez',
            'email' => 'juan@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
    }

    /**
     * @dataProvider rolesData
     */
    public function test_authenticated_user_can_not_register($role)
    {
        Passport::actingAs(
            User::factory()->create([
                'email' => 'juan@gmail.com',
                'role' => $role
            ])
        );

        $response = $this->post('/register', [
            'first_name' => 'juan',
            'last_name' => 'perez',
            'email' => 'juan@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertCount(1, User::where('email', '=', 'juan@gmail.com')->get());
    }

    public function rolesData(): array
    {
        return [
            ['admin'],
            ['customer']
        ];
    }

}
