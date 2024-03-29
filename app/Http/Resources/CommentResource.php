<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CommentResource extends JsonResource {

    public function toArray($request): array|JsonSerializable|Arrayable {
        return [
            'author' => new UserResource($this->author),
            'content' => $this->content,
            'post' => new PostResource($this->post)
        ];
    }
}
