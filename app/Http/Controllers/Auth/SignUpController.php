<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
            $avatar = Image::make([
                'URL' => $path,
                'imageable_type' => User::class,
                'imageable_id' => $user
            ]);
            $user->image()->save($avatar);
        }

        event(new Registered($user));
        return response(status: 201);
    }
}
