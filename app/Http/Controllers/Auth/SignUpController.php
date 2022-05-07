<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller {

    public function signup(SignUpRequest $request) {
        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")), //todo make the has part of the user model
        ]);
        event(new Registered($user));
        return response(status: 201);
    }
}
