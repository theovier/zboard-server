<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowPostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_get_single_post() {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)
            ->getJson('/api/posts/1');

        $response->assertSuccessful();
    }

    public function test_unauthenticated_user_can_get_single_post() {
        $this->getJson('/api/posts/1')
            ->assertSuccessful();
    }

    public function test_show_returns_data_in_valid_format() {
        $this->getJson('/api/posts/1')
            ->assertSuccessful()
            ->assertJsonStructure([
                'id',
                'author' => [
                    'id',
                    'name',
                    'profile_picture_url',
                    'company' => [
                        'name'
                    ]
                ],
                'title',
                'content',
                'created_at',
                'updated_at',
            ]);
    }

    public function test_post_is_shown_correctly() {
        $author = User::factory()->create([
            'name' => 'Au Thor',
            'company_id' => null
        ]);
        $post = Post::factory()->create([
            'title' => 'My Title',
            'content' => 'My Content',
            'author_id' => $author
        ]);

        $response = $this->getJson('/api/posts/' . $post->id);

        $response->assertSuccessful()
            ->assertExactJson([
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'author' => [
                    'id' => $author->id,
                    'name' => $author->name,
                    'profile_picture_url' => null,
                    'company' => null
                ],
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at
            ]);
    }

    public function test_show_for_missing_post() {
        $this->getJson('/api/posts/0')
            ->assertNotFound()
            ->assertJsonStructure(['error']);
    }
}

