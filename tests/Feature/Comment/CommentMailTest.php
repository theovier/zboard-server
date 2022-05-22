<?php

namespace Tests\Feature\Comment;

use App\Mail\CommentReceived;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentMailTest extends TestCase {
    use RefreshDatabase;

    public function test_comment_mail_content() {
        $comment = Comment::factory()->create();

        $mailable = new CommentReceived($comment);

        $mailable->assertSeeInText($comment->content);
        $mailable->assertSeeInText($comment->author->name);
        $mailable->assertSeeInText($comment->post->title);
        $mailable->assertSeeInText($comment->post->content);
    }

    public function test_profile_picture_in_comment_mail() {
        $postAuthor = User::factory()->create([
            'profile_picture_url' => 'someURL'
        ]);
        $post = Post::factory()->create([
            'author_id' => $postAuthor
        ]);
        $commentator = User::factory()->create();
        $comment = Comment::factory()->create([
            'author_id' => $commentator,
            'post_id' => $post
        ]);

        $mailable = new CommentReceived($comment);

        $mailable->assertSeeInHtml($postAuthor->profile_picture_url);
    }

    public function test_email_content_correct_when_profile_picture_is_null() {
        $post = Post::factory()->create([
            'author_id' => User::factory()->create()
        ]);
        $comment = Comment::factory()->create([
            'author_id' => User::factory()->create(),
            'post_id' => $post
        ]);

        $mailable = new CommentReceived($comment);

        $mailable->assertSeeInText($comment->content);
        $mailable->assertSeeInText($comment->author->name);
        $mailable->assertSeeInText($comment->post->title);
        $mailable->assertSeeInText($comment->post->content);
    }
}

