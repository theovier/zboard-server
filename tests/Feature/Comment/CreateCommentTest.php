<?php

namespace Tests\Feature\Comment;

use App\Mail\CommentReceived;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateCommentTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_create_comment() {
        Mail::fake();
        $user = User::factory()->create();
        $payload = [
            'post_id' => 1,
            'content' => 'My Test Content'
        ];

        $response = $this
            ->actingAs($user)
            ->postJson('api/comments', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', $payload);
    }

    public function test_author_is_correctly_set() {
        Mail::fake();
        $author = User::factory()->create([
            'company_id' => null,
            'profile_picture_url' => null
        ]);
        $payload = [
            'post_id' => 1,
            'content' => 'My Other Test Content'
        ];

        $response = $this
            ->actingAs($author)
            ->postJson('api/comments', $payload);

        $response
            ->assertCreated()
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('author.id', $author->id)
                    ->etc()
            );
    }

    public function test_unauthenticated_user_cannot_create_comment() {
        Mail::fake();
        $payload = [
            'content' => 'My Content'
        ];

        $response = $this->postJson('api/comments', $payload);

        $response->assertUnauthorized();
        $this->assertDatabaseMissing('comments', $payload);
        Mail::assertNothingSent();
    }

    public function test_post_author_is_notified_of_comment_by_mail() {
        Mail::fake();
        $user = User::factory()->create();
        $author = User::factory()->create();
        $post = Post::factory()->create([
            'author_id' => $author
        ]);

        $payload = [
            'post_id' => $post->id,
            'content' => 'My Test Content'
        ];

        $this
            ->actingAs($user)
            ->postJson('api/comments', $payload);

        Mail::assertSent(CommentReceived::class, function ($mail) use ($author) {
            return $mail->hasTo($author->email);
        });
    }

    /**
     * @dataProvider validInputs
     */
    public function test_valid_inputs($payload) {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('api/comments', $payload);

        $response->assertCreated();
    }

    /**
     * @dataProvider invalidInputs
     */
    public function test_invalid_inputs($payload) {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson('api/comments', $payload);

        $response->assertUnprocessable();
    }

    private function validInputs(): array {
        return [
            [
                [
                    'post_id' => 1,
                    'content' => 'My Content'
                ]
            ],
            [
                [
                    'post_id' => 2,
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
                    'post_id' => 1,
                    'content' => Str::random(65001),
                ]
            ],
            [
                [
                    'content' => Str::random(1)
                ]
            ],
            [
                [
                    'post_id' => null,
                    'content' => Str::random(500)
                ]
            ]
        ];
    }
}

