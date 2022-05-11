<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    //todo check email verification
    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response(status: 204);
        } else {
            return response(["msg" => "Credentials do not match"], 401);
        }
    }
}
