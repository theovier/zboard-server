<?php

namespace App\Http\Requests;

use App\Rules\EmailDomain;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest {
    public function rules() {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new EmailDomain()],
            'password' => ['required', 'string', 'min:8',],
            'name' => ['required', 'alpha_dash', 'string', 'max:255'],
        ];
    }
}
