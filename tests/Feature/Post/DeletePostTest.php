<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePostTest extends TestCase {
    use RefreshDatabase;

    public function test_author_can_delete_post() {
        $author = User::factory()->create();
        $postData = [
            'title' => 'My Test Title',
            'content' => $this->faker->realText,
            'author_id' => $author->id
        ];
        $post = Post::create($postData);

        $response = $this
            ->actingAs($author)
            ->deleteJson('/api/posts/' . $post->id);

        $response->assertSuccessful();
        $this->assertDatabaseMissing('posts', $postData);
    }

    public function test_user_who_is_not_the_author_cannot_delete_post() {
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $postData = [
            'title' => 'My Test Title',
            'content' => $this->faker->realText,
            'author_id' => $author->id
        ];
        $post = Post::create($postData);

        $response = $this
            ->actingAs($notAuthor)
            ->deleteJson('/api/posts/' . $post->id);

        $response->assertForbidden();
        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_unauthorized_user_cannot_access_delete_endpoint() {
        $postData = [
            'title' => 'My Test Title',
            'content' => $this->faker->realText,
            'author_id' => 1
        ];
        $post = Post::create($postData);

        $response = $this->deleteJson('/api/posts/' . $post->id);

        $response->assertUnauthorized();
        $this->assertDatabaseHas('posts', $postData);
    }
}


