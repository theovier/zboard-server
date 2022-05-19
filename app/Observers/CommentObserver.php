<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver {

    public function created(Comment $comment) {
        //todo send email to original post author
    }

}
