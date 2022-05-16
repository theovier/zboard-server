<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexPostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_get_all_posts() {
        Post::factory(2)->create();

        $this->getJson('/api/posts')
            ->assertStatus(200)
            ->assertJsonCount('data', 2);
    }

    public function test_unauthenticated_user_can_get_all_posts() {

    }

    public function test_index_returns_data_in_valid_format() {

    }

    public function test_show_for_missing_post() {
        //https://auth0.com/blog/testing-laravel-apis-with-phpunit/
    }
}

