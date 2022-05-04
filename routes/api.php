<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("heartbeat", function() {
    return [
        "hello" => "world"
    ];
});
Route::post("login", [LoginController::class, "login"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
