<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource {

    public function toArray($request): array|JsonSerializable|Arrayable {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'profile_picture' => null //todo
        ];
    }
}
