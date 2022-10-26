<?php

namespace Api\User;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;
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

}
