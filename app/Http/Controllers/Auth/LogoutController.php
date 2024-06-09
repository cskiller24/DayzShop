<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LogoutController extends Controller
{
    public function __construct(private StatefulGuard $guard)
    {

    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->guard->logout();

        if($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerate();
        }

        return $request->wantsJson()
            ? new JsonResponse('', SymfonyResponse::HTTP_NO_CONTENT)
            : redirect()->route('login', status: SymfonyResponse::HTTP_MOVED_PERMANENTLY);
    }
}
