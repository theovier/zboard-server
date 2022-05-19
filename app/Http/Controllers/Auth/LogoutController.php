<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller {

    public function logout(Request $request) {
        auth()->guard('web')->logout(); //see https://github.com/laravel/sanctum/issues/87
        return response()->noContent();
    }
}
