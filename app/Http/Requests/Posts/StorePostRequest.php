<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest {

    public function rules() {
        return [
            'title' => ['required', 'string', 'max:150'],
            'content' => ['nullable', 'string', 'max:65000']
        ];
    }
}
