<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller {

    private $successURL = "/email/verify/success";
    private $alreadyVerifiedURL = "/email/verify/already-success";

    public function verify(EmailVerificationRequest $request): RedirectResponse {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect()->away(env('APP_FRONTEND_URL') . $this->alreadyVerifiedURL);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->away(env('APP_FRONTEND_URL') .  $this->successURL);
    }

    public function resend(Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return response(status: 204);
        }
        $request->user()->sendEmailVerificationNotification();

        return new JsonResponse(['message' => 'Verification link sent.'], 202);
    }

}
