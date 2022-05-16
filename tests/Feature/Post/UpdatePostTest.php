<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdatePostTest extends TestCase {
    use RefreshDatabase;

    public function test_update_post_endpoint_not_available() {
        $this->putJson('/api/posts/1')
            ->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED)
            ->assertJsonStructure(['error']);
    }
}

