<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            if ($user->isVerified()) {
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
