<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexPostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_get_all_posts() {
        $authenticatedUser = User::factory()->create();

        $this->actingAs($authenticatedUser)
            ->getJson('/api/posts')
            ->assertSuccessful()
            ->assertJsonCount(10, 'data');
    }

    public function test_unauthenticated_user_can_get_all_posts() {
        $this->getJson('/api/posts')
            ->assertSuccessful()
            ->assertJsonCount(10, 'data');
    }

    public function test_index_returns_data_in_valid_format() {
        $this->getJson('/api/posts')
            ->assertSuccessful()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'author' => [
                        'id',
                        'name',
                        'profile_picture_url'
                    ],
                    'title',
                    'content',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }
}

