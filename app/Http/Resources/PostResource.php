<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PostResource extends JsonResource {

    public function toArray($request): array|JsonSerializable|Arrayable {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => new UserResource($this->author),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
