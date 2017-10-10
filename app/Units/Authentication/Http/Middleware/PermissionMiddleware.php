<?php

namespace MVG\Units\Authentication\Http\Middleware;

use Illuminate\Support\Facades\Auth;

/**
 * Class PermissionMiddleware
 *
 */
class PermissionMiddleware
{
    public function handle($request, \Closure $next, $permission)
    {
        if (Auth::guest()) {
            abort(403);
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return $next($request);
            }
        }

        abort(403);
    }
}