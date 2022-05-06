<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase {
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials() {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'secret'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_not_login_with_incorrect_credentials() {
        $response = $this->postJson('/api/login', [
            'email' => "does@not.exist",
            'password' => "secret",
        ]);

        $response->assertUnauthorized();
        $this->assertGuest();
    }
}
