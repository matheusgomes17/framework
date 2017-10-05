<?php

namespace MVG\Units\Authentication\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class RoleMiddleware
 * @package MVG\Units\Authentication\Http\Middleware
 */
class RoleMiddleware
{
    /**
     * @param $request
     * @param \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, \Closure $next, $role)
    {
        if (Auth::guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $role = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::user()->hasAnyRole($role)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}