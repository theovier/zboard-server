<?php

namespace App\Observers;

use App\Mail\CommentReceived;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;

class CommentObserver {

    public function created(Comment $comment) {
        $post = $comment->post;
        $postAuthor = $post->author;
        Mail::to($postAuthor)->send(new CommentReceived($comment));
    }
}
