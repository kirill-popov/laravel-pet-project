<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Services\User\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureInviteIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function __construct(
        protected readonly UserService $userService,
    )
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;
        $token = $request->token;
        $invite = $this->userService->findInvite($id, $token);
        if (!$invite) {
            return response(['message'=>'Invitation not found.'], 404);
        }

        return $next($request);
    }
}
