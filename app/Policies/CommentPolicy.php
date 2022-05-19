<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy {
    use HandlesAuthorization;

    public function create(User $user): Response|bool  {
        return $user->isVerified()
            ? Response::allow()
            : Response::deny('Only verified users may reply to posts.');
    }
}
