<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest {

    public function rules() {
        return [
            'post_id' => ['required', 'exists:posts'],
            'content' => ['required', 'string', 'max:65000']
        ];
    }
}
