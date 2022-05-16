<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller {

    public function index(): AnonymousResourceCollection {
        return PostResource::collection(Post::all());
    }

    public function show(): PostResource {
        return new PostResource($this);
    }

    public function store(StorePostRequest $request): Response {
        //todo
        return Response(null, 501);
    }

    public function destroy(Post $post): Response {
        //todo check if the user requesting the deletion is the author, otherwise deny it.
        $post->delete();
        return response()->noContent();
    }
}
