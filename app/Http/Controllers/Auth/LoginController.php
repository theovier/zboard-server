<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    //todo check email verification
    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            //todo get user and check if email verified
            if (Auth::user()->email_verified_at) {
                return response(status: 204);
            } else {
                //todo should not send this security related piece of information, but o.k. for prototype
                return response(["msg" => "Email not yet verified"], 401);
            }

        } else {
            return response(["msg" => "Credentials do not match"], 401);
        }
    }
}
