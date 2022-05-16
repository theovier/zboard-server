<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreatePostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post() {
        $user = User::factory()->create();
        $payload = [
            'title' => 'My Title',
            'content' => 'My Content'
        ];

        $response = $this
            ->actingAs($user)
            ->postJson('api/posts', $payload);

        $response
            ->assertCreated()
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

    public function test_author_is_correctly_set() {
        $author = User::factory()->create();
        $payload = [
            'title' => 'My Title',
            'content' => 'My Content'
        ];

        $response = $this
            ->actingAs($author)
            ->postJson('api/posts', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'author' => [
                    'id' => $author->id,
                    'name' => $author->name,
                    'profile_picture' => null
                ]
            ]);
    }

    public function test_unauthenticated_user_cannot_create_post() {
        $payload = [
            'title' => 'My Test Title',
            'content' => 'My Content'
        ];

        $response = $this->postJson('api/posts', $payload);

        $response->assertUnauthorized();
        $this->assertDatabaseMissing('posts', $payload);
    }

    /**
     * @dataProvider validInputs
     */
    public function test_valid_inputs($payload) {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('api/posts', $payload);

        $response->assertCreated();
    }

    /**
     * @dataProvider invalidInputs
     */
    public function test_invalid_inputs($payload) {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('api/posts', $payload);

        $response->assertUnprocessable();
    }

    private function validInputs(): array {
        return [
            [
                [
                    'title' => 'My Title',
                    'content' => 'My Content'
                ]
            ],
            [
                [
                    'title' => 'My Title',
                    'content' => null
                ]
            ],
            [
                [
                    'title' => 'My Title',
                ]
            ],
            [
                [
                    'title' => Str::random(150),
                    'content' => Str::random(65000)
                ]
            ]
        ];
    }

    private function invalidInputs(): array {
        return [
            [
                [

                ]
            ],
            [
                [
                    'title' => Str::random(501),
                    'content' => Str::random(65001),
                ]
            ],
            [
                [
                    'title' => Str::random(150),
                    'content' => Str::random(65001)
                ]
            ],
            [
                [
                    'content' => Str::random(500)
                ]
            ],
            [
                [
                    'title' => null,
                    'content' => Str::random(500)
                ]
            ]
        ];
    }
}

