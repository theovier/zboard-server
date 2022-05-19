<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class SignUpController extends Controller {

    public function signup(SignUpRequest $request) {
        $user = User::make([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
        ]);

        if ($request->has('picture')) {
            $path = $request->file('picture')->storePublicly('images');
            $user->profile_picture_url = asset($path);
        }

        $user->save();
        event(new Registered($user));
        return response(status: 201);
    }
}
