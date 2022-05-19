<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller {

    public function index() {
        return CommentResource::collection(Comment::all());
    }

    public function show(Comment $comment): CommentResource {
        return new CommentResource($comment);
    }

    public function store(StoreCommentRequest $request) {
        //todo
    }
}
