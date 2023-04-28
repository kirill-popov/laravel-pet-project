<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\InviteRepositoryInterface;
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

    protected $inviteRepository;

    public function __construct(InviteRepositoryInterface $inviteRepository)
    {
        $this->inviteRepository = $inviteRepository;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;
        $token = $request->token;
        $invite = $this->inviteRepository->findInvite($id, $token);
        if (!$invite) {
            return response(['message'=>'Invitation not found.'], 404);
        }

        return $next($request);
    }
}
