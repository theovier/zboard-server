<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest {
    public function rules() {
        $emailDomain = preg_replace('/.+@/', '', $this->email);

        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            $emailDomain => ['exists:allowed_domains'],
            'password' => ['required', 'string', 'min:8',],
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
