<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CompanyResource extends JsonResource {

    public function toArray($request): array|JsonSerializable|Arrayable {
        return [
            'name' => $this->name
        ];
    }
}
