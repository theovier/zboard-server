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

    public function show(Post $post): PostResource {
        return new PostResource($post);
    }

    public function store(StorePostRequest $request): Response {
        return Response(null, 501); //todo
    }

    public function destroy(Post $post): Response {
        $this->authorize('delete', $post);
        $post->delete();
        return response()->noContent();
    }
}
