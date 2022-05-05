<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_logout() {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->postJson('/api/logout');

        $response->assertSuccessful();
        $this->assertGuest('web');
    }

    public function test_unauthenticated_user_can_not_logout() {
        $response = $this->postJson('/api/logout');
        $response->assertUnauthorized();
    }
}
