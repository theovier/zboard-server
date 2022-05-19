<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function index() {
        return CommentResource::collection(Comment::all());
    }

    public function show(Comment $comment): CommentResource {
        return new CommentResource($comment);
    }

    public function store(StoreCommentRequest $request) {
        $this->authorize('create', Comment::class);
        $comment = Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'author_id' => Auth::user()->id
        ]);
        return new CommentResource($comment);
    }
}
