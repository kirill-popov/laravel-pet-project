<?php

namespace App\Http\Middleware;

use App\Services\User\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EnsureInviteIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function __construct(
        protected readonly UserService $userService,
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;
        $token = $request->token;
        $invite = $this->userService->findInvite($id, $token);
        if (!$invite) {
            throw new NotFoundHttpException();
        }

        return $next($request);
    }
}
