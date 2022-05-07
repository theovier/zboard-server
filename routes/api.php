<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("heartbeat", function() {
    return [
        "hello" => "world"
    ];
});

Route::get("users", function() {
    return User::all();
});

Route::post("login", [LoginController::class, "login"]);
Route::post("signup", [SignUpController::class, "signup"]);

Route::middleware('auth:sanctum')->group(function() {
    Route::post("logout", [LogoutController::class, "logout"]);

    Route::get('/user', function(Request $request) {
        return $request->user();
    });
});
