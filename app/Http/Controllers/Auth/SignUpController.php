<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SignUpController extends Controller {

    public function signup(SignUpRequest $request) {
        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
        ]);

        if ($request->has('picture')) {
            $path = Storage::putFile('avatars', $request->file('picture'));
            //todo create image relationship on user
            Log::debug($path);
        }

        event(new Registered($user));
        return response(status: 201);
    }
}
