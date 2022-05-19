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

//auth
Route::post("login", [LoginController::class, "login"]);
Route::post("signup", [SignUpController::class, "signup"]);
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
Route::post('/email/verify/resend',  [VerificationController::class, 'resend'])
    ->middleware(['auth:api', 'throttle:6,1'])
    ->name('verification.send');

//publicly accessible models; cannot use Route::apiResource because we split the routes based on authorization (see below)
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post("logout", [LogoutController::class, "logout"]);

    Route::get('/user', function(Request $request) {
        //todo rename to /me
        return $request->user();
    });

    Route::delete('posts/{post}', [PostController::class, 'destroy']); //has to be /{posts}; /{id} is not working with type-hinting
    Route::post('posts', [PostController::class, 'store']);

    Route::apiResource("posts", PostController::class)
        ->only("create", "delete");
});
