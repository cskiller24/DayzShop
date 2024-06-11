<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LimboController extends Controller
{
    public function __invoke(Request $request): View|JsonResponse
    {
        if ($request->wantsJson()) {
            return new JsonResponse(data: [
                'message' => "The user with an email of {$request->user()?->email} does not have any roles",
            ], status: SymfonyResponse::HTTP_UNAUTHORIZED);
        }

        return view('limbo');
    }
}
