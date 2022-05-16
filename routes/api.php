<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("heartbeat", function() {
    return [
        "hello" => "world"
    ];
});

Route::apiResource("posts", PostController::class); //todo move under auth

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verify/resend',  [VerificationController::class, 'resend'])
    ->middleware(['auth:api', 'throttle:6,1'])
    ->name('verification.send');


Route::post("login", [LoginController::class, "login"]);
Route::post("signup", [SignUpController::class, "signup"]);

Route::middleware('auth:sanctum')->group(function() {
    Route::post("logout", [LogoutController::class, "logout"]);

    Route::get('/user', function(Request $request) {
        return $request->user();
    });
});
