<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response(["success" => true], 200);
        } else {
            return response(["success" => false], 403);
        }
    }
}
