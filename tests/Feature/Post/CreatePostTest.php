<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post() {
        $user = User::factory()->create();
        $payload = [
            'title' => 'My Title',
            'content' => 'My Content'
        ];

        $response = $this->actingAs($user)
            ->postJson('api/posts', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'author' => [
                        'id',
                        'name',
                        'profile_picture'
                    ],
                    'title',
                    'content',
                    'created_at',
                    'updated_at',
                ]
            ]);
        $this->assertDatabaseHas('posts', $payload);
    }

    public function test_unauthenticated_user_cannot_create_post() {
        $payload = [
            'title' => 'My Test Title',
            'content' => 'My Content'
        ];

        $response = $this->postJson('api/posts', $payload);

        $response->assertForbidden()
            ->assertJsonStructure(['error']);
        $this->assertDatabaseMissing('posts', $payload);
    }

    //todo test for valid/invalid inputs once the form validation is created

}

