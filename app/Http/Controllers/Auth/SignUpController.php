<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class SignUpController extends Controller {

    public function signup(SignUpRequest $request) {
        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
        ]);
        event(new Registered($user));
        return response(status: 201);
    }
}
