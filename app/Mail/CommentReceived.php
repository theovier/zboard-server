<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentReceived extends Mailable {
    use Queueable, SerializesModels;

    public Comment $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function build() {
        return $this
            ->markdown('emails.posts.comments.received', [
                'comment' => $this->comment
            ]);
    }
}
