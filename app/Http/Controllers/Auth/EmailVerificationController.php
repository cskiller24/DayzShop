<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        if ($request->user() instanceof MustVerifyEmail) {
            $request->user()->sendEmailVerificationNotification();
        }

        toast(__('auth.verification-send'), 'Success');

        return redirect()->back();
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('welcome');
    }
}
