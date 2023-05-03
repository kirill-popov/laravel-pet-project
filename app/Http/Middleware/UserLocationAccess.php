<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLocationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $location = $request->location;
        if ($location) {
            if ($request->user()->shop->is($location->shop)) {
                return $next($request);
            } else {
                return response(['message'=>'Forbidden.'], 403);
            }
        }
        return $next($request);
    }
}
