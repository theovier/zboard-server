<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentObserver {

    public function created(Comment $comment) {
        //todo send email to original post author
        Log::debug($comment);
    }

}
